@props(['pageTitle' => 'Default Title', 'postTitle' => null, 'meta_seo' => null])

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="ltr" class="light layout-boxed null nav-floating horizontalMenu">

<head>
  <meta name="google-site-verification" content="gpUaM5EXvPSz74UM1fEriWPlrvVtFumpZlN5iQCmKlA" />
  <meta charset="utf-8">
  <script async src="https://www.googletagmanager.com/gtag/js?id=G-T5G37F1X1Y"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-T5G37F1X1Y');
</script>
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
  <meta http-equiv="content-language" content="{{ currentLang() === 'vn' ? 'vi' : 'en' }}">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="canonical" href="{{ url()->current() }}" />

  @hasSection('description')
    <meta name="description" content="@yield('description')">
  @else
    <meta name="description" content="{{ setting('description') }}">
  @endif
  @hasSection('keywords')
    <meta name="keywords" content="@yield('keywords')">
  @else
    <meta name="keywords" content="{{ setting('keywords') }}">
  @endif
  <meta name="author" content="{{ setting('author') }}">
  <meta name="robots" content="index, follow">
  <meta name="googlebot" content="index, follow">
  <meta name="google" content="notranslate">
  <meta name="generator" content="{{ strtoupper($_SERVER['HTTP_HOST']) }}">

  <meta name="application-name" content="{{ setting('title') }}">
  <meta property="og:image" content="{{ asset(setting('logo_share')) }}">
  <meta property="og:image:secure_url" content="{{ asset(setting('logo_share')) }}">
  {{-- <meta property="og:image:width" content="128">
  <meta property="og:image:height" content="128"> --}}
  {{-- <meta property="og:image:type" content="image/png"> --}}
  <meta property="og:image:alt" content="{{ setting('title') }}">
  <meta property="og:title" content="{{ setting('title') }}">
  <meta property="og:site_name" content="{{ setting('title') }}">
  <meta property="og:description" content="{{ setting('description') }}">
  <meta property="og:url" content="{{ url()->current() }}">
  <meta property="og:type" content="website">

  <link rel="shortcut icon" href="{{ asset(setting('favicon')) }}" type="image/x-icon">

  @hasSection('postTitle')
    <title>@yield('postTitle')</title>
  @endif
  @hasSection('title')
    <title>@yield('title') - {{ setting('title') }}</title>
  @else
    @hasSection('pageTitle')
      <title>@yield('pageTitle')</title>
    @else
      <title>{{ setting('title') }}</title>
    @endif
  @endif

  <script src="https://cdn.jsdelivr.net/npm/pace-js@latest/pace.min.js"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/pace-js@latest/pace-theme-default.min.css">

  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@600;700;800&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Signika:wght@600;700;800&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Play:wght@600;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

  {{-- Scripts --}}
  <script>
    window.webData = @json([
        'csrfToken' => csrf_token(),
    ]);
    window.userData = @json(auth()->user());
    window.siteDomain = '{{ domain() }}';
  </script>

  @vite(['resources/css/app.scss', 'resources/js/custom/store.js'])

  @include('layouts.partials.custom-head')

  @stack('css')
  @yield('css')

  {!! Helper::getNotice('header_script') !!}

  <script>
    window.LANG = @json(getLangJson() ?? [])


    window.$__t = function(key) {
      if (window.LANG[key] === undefined) {
        // console.log(key);
      }
      return window.LANG[key] || key;
    }

    window.__defaultLang = '{{ currentLang() }}';
    window.__usdRate = '{{ usdRate() }}';

    window.$formatCurrency = function(number, currency = 'VND', maxinum = 0) {
      return new Intl.NumberFormat('vi-VN', {
        style: 'currency',
        currency: __defaultLang === 'vn' ? 'VND' : 'USD',
        maximumFractionDigits: maxinum,
      }).format(number);
    }

    window.__DEFAULT_THEME = '{{ setting('default_theme', 'light') }}';
  </script>
</head>

<body class="font-inter dashcode-app" id="body_class">
  <div class="app-wrapper">

    <x-sidebar-menu />
    @if (theme_config('enable_custom_theme', false))
      <x-dashboard-settings />
      @endif

    <div class="flex min-h-screen flex-col justify-between">
      <div>
        <x-dashboard-header />
        <div class="content-wrapper transition-all duration-150 ltr:ml-0 rtl:mr-0 xl:ltr:ml-[248px] xl:rtl:mr-[248px]" id="content_wrapper">
          <div class="page-content">
            <div class="container-fluid transition-all duration-150" id="page_layout">
              <main id="content_layout">
                <div class="mb-3">
                  @include('components.x-alert')
                </div>

                {{ $slot }}
              </main>
            </div>
          </div>
        </div>
      </div>

      <x-dashboard-footer />
      </div>
  </div>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/2.0.11/clipboard.min.js"></script>

  @vite(['resources/js/app.js', 'resources/js/main.js', 'resources/js/functions.js'])

  @php
    $get_gift = Helper::getConfig('get_gift');
  @endphp
  @if (isset($get_gift['status']) && $get_gift['status'] == 1)
    <style type="text/css">
      #bonus {
        position: fixed;
        bottom: 15px;
        left: 15px;
        width: 13%;
        z-index: 1000;
        cursor: pointer;
      }

      #bonus img {
        width: 100%;
      }

      #bonus_login {
        display: block;
        position: fixed;
        bottom: 85px;
        left: 15px;
        width: 13%;
        z-index: 1000;
        cursor: pointer;
      }

      #bonus_login img {
        width: 100%;
      }

      .mobile {
        width: 30% !important;
      }

      @media only screen and (max-width: 640px) {
        #bonus_login {
          width: 40% !important;
          !important;
        }

        #bonus {
          width: 40% !important;
          !important;
        }
      }

      #bonusModal .modal-body p,
      #bonusModal .modal-body b {
        display: inline;
        color: #000
      }
    </style>
    @if (auth()->check() && auth()->user()->received_gift === false)
      <a id="bonus_login" href="javascript:void(0)" onclick="receiveGift()" title="Click để nhận thưởng!" class="">
        <img src="{{ $get_gift['image'] ?? '' }}" width="{{ $get_gift['width'] ?? '500' }}px" @isset($get_gift['height']) height="{{ $get_gift['height'] }}px" @endisset>
      </a>
      <script>
        function receiveGift() {
          axios.post('/api/users/gift-rewards/claim').then((response) => {
            Swal.fire('Chúc Mừng!', response.data.message, 'success').then(() => {
              location.reload();
            });
          }).catch(error => {
            Swal.fire('Thất bại!', $catchMessage(error), 'error');
          });
        }
      </script>
    @elseif(!auth()->check())
      <a id="bonus_login" href="{{ route('login') }}" title="Click để nhận thưởng!" class="">
        <img src="{{ $get_gift['image'] ?? '' }}" width="{{ $get_gift['width'] ?? '500' }}px" @isset($get_gift['height']) height="{{ $get_gift['height'] }}px" @endisset>
      </a>
    @endif
  @endif

  @stack('scripts')
  @yield('scripts')

  {!! Helper::getNotice('footer_script') !!}

  @if (currentLang() !== 'en')
    <script>
      window.gtranslateSettings = {
        "default_language": "vi",
        "native_language_names": true,
        "globe_color": "#66aaff",
        "wrapper_selector": ".gtranslate_wrapper",
        "flag_size": 28,
        "alt_flags": {
          "en": "usa"
        },
        "globe_size": 24
      }
    </script>
    <script src="https://cdn.gtranslate.net/widgets/latest/globe.js" defer></script>
  @endif

  <div style="position: fixed; bottom: 125px; right: 20px; z-index: 10000; font-family: Arial, sans-serif;">
    
    <div id="effect-menu-list" style="display: none; position: absolute; bottom: 55px; right: 0; background: #fff; border: 1px solid #e2e8f0; border-radius: 12px; box-shadow: 0 10px 25px rgba(0,0,0,0.15); width: 180px; overflow: hidden; animation: slideUp 0.2s ease;">
      <div style="padding: 10px 14px; background: #f8fafc; font-size: 12px; font-weight: bold; color: #64748b; border-bottom: 1px solid #e2e8f0;">
        CHỌN HIỆU ỨNG
      </div>
      <button onclick="changeEffect('none')" class="effect-item" style="width: 100%; padding: 10px 14px; text-align: left; background: none; border: none; font-size: 14px; color: #334155; cursor: pointer; display: flex; align-items: center; gap: 8px;">
        ❌ Không hiệu ứng
      </button>
      <button onclick="changeEffect('snow')" class="effect-item" style="width: 100%; padding: 10px 14px; text-align: left; background: none; border: none; font-size: 14px; color: #334155; cursor: pointer; display: flex; align-items: center; gap: 8px;">
        ✨ Tuyết vàng kim
      </button>
      <button onclick="changeEffect('apricot')" class="effect-item" style="width: 100%; padding: 10px 14px; text-align: left; background: none; border: none; font-size: 14px; color: #334155; cursor: pointer; display: flex; align-items: center; gap: 8px;">
        🌸 Hoa mai vàng
      </button>
      <button onclick="changeEffect('peach')" class="effect-item" style="width: 100%; padding: 10px 14px; text-align: left; background: none; border: none; font-size: 14px; color: #334155; cursor: pointer; display: flex; align-items: center; gap: 8px;">
        💮 Hoa đào hồng
      </button>
      <button onclick="changeEffect('leaves')" class="effect-item" style="width: 100%; padding: 10px 14px; text-align: left; background: none; border: none; font-size: 14px; color: #334155; cursor: pointer; display: flex; align-items: center; gap: 8px;">
        🍂 Lá thu rụng
      </button>
    </div>

    <button id="effect-main-btn" onclick="toggleEffectMenu()" title="Thay đổi hiệu ứng giao diện" 
            style="width: 45px; height: 45px; border-radius: 50%; background: #fff; border: 1px solid #e2e8f0; box-shadow: 0 4px 12px rgba(0,0,0,0.1); display: flex; align-items: center; justify-content: center; cursor: pointer; transition: all 0.2s ease;">
      <i id="effect-btn-icon" class="fas fa-snowflake" style="color: #ffd700; font-size: 18px;"></i>
    </button>
  </div>

  <script>
    let activeFlakes = [];
    let currentEffect = 'snow';

    const effectConfig = {
      snow: { symbols: ['❄', '❅', '❆'], colors: ['#ffd700', '#ffd700', '#ff4747'], size: 1.2, shadow: 'rgba(0,0,0,0.2)' },
      apricot: { symbols: ['🌸', '✨'], colors: ['#ffea00', '#ffa600'], size: 1.4, shadow: 'rgba(0,0,0,0.1)' },
      peach: { symbols: ['🌸', '💮'], colors: ['#ffb7c5', '#ff85a2'], size: 1.4, shadow: 'rgba(0,0,0,0.1)' },
      leaves: { symbols: ['🍂', '🍁'], colors: ['#d97706', '#b91c1c', '#ea580c'], size: 1.3, shadow: 'rgba(0,0,0,0.15)' }
    };

    document.addEventListener("DOMContentLoaded", function () {
      const savedEffect = localStorage.getItem("user_web_effect");
      if (savedEffect !== null) {
        currentEffect = savedEffect;
      }

      const style = document.createElement("style");
      style.innerHTML = `
        .falling-item {
          position: fixed;
          top: -20px;
          pointer-events: none;
          z-index: 9999;
          animation-name: globalFall;
          animation-iteration-count: infinite;
          animation-timing-function: linear;
          transition: opacity 0.5s ease;
        }
        @keyframes globalFall {
          0% { transform: translateY(0) rotate(0deg); opacity: 1; }
          100% { transform: translateY(105vh) rotate(360deg); opacity: 0.3; }
        }
        @keyframes slideUp {
          from { transform: translateY(10px); opacity: 0; }
          to { transform: translateY(0); opacity: 1; }
        }
        .effect-item:hover {
          background-color: #f1f5f9 !important;
          color: #ff4747 !important;
        }
        #effect-main-btn:hover {
          transform: scale(1.1);
          box-shadow: 0 6px 16px rgba(0,0,0,0.15);
        }
      `;
      document.head.appendChild(style);

      if (currentEffect !== 'none') {
        startFallingEffect(currentEffect);
      }
      updateMenuButtonIcon();
    });

    function toggleEffectMenu() {
      const menu = document.getElementById("effect-menu-list");
      if (menu.style.display === "none" || menu.style.display === "") {
        menu.style.display = "block";
      } else {
        menu.style.display = "none";
      }
    }

    window.addEventListener('click', function(e) {
      if (!document.getElementById('effect-main-btn').contains(e.target)){
        document.getElementById("effect-menu-list").style.display = "none";
      }
    });

    function startFallingEffect(type) {
      clearCurrentEffect();
      if (type === 'none') return;

      const config = effectConfig[type];
      const body = document.body;
      const count = 35;

      for (let i = 0; i < count; i++) {
        const flake = document.createElement("div");
        flake.className = "falling-item";
        flake.innerHTML = config.symbols[Math.floor(Math.random() * config.symbols.length)];
        
        const duration = Math.random() * 6 + 6;
        const delay = Math.random() * 6;
        const left = Math.random() * 100;
        const size = Math.random() * 0.5 + 0.6;

        flake.style.left = left + "vw";
        flake.style.animationDuration = duration + "s";
        flake.style.animationDelay = "-" + delay + "s";
        flake.style.transform = `scale(${size * config.size})`;
        flake.style.color = config.colors[Math.floor(Math.random() * config.colors.length)];
        flake.style.textShadow = `0 0 5px ${config.shadow}`;
        flake.style.opacity = Math.random() * 0.6 + 0.4;

        body.appendChild(flake);
        activeFlakes.push(flake);
      }
    }

    function clearCurrentEffect() {
      activeFlakes.forEach(item => item.remove());
      activeFlakes = [];
    }

    function changeEffect(type) {
      currentEffect = type;
      localStorage.setItem("user_web_effect", type);
      startFallingEffect(type);
      updateMenuButtonIcon();
      document.getElementById("effect-menu-list").style.display = "none";
    }

    // Tự động đổi biểu tượng của nút chính tùy thuộc vào hiệu ứng đang chạy
    function updateMenuButtonIcon() {
      const icon = document.getElementById("effect-btn-icon");
      if (currentEffect === 'none') {
        icon.className = "fas fa-magic";
        icon.style.color = "#94a3b8";
      } else if (currentEffect === 'snow') {
        icon.className = "fas fa-snowflake";
        icon.style.color = "#ffd700";
      } else if (currentEffect === 'apricot' || currentEffect === 'peach') {
        icon.className = "fas fa-spa";
        icon.style.color = currentEffect === 'apricot' ? '#ffa600' : '#ff85a2';
      } else if (currentEffect === 'leaves') {
        icon.className = "fas fa-leaf";
        icon.style.color = "#ea580c";
      }
    }
  </script>
  <!-- ==================== HỆ THỐNG AI CHATBOT VIPPRO TRỰC TIẾP TRÊN WEB (ĐÃ CHỈNH VỊ TRÍ) ==================== -->
  <div style="position: fixed; bottom: 185px; right: 20px; z-index: 10000; font-family: Arial, sans-serif;">
    
    <div id="ai-chatbox-window" style="display: none; position: absolute; bottom: 60px; right: 0; width: 340px; height: 450px; background: #fff; border-radius: 16px; box-shadow: 0 12px 40px rgba(0,0,0,0.15); border: 1px solid #e2e8f0; flex-direction: column; overflow: hidden; animation: chatSlideUp 0.3s ease;">
      
      <div style="padding: 14px 16px; background: linear-gradient(135deg, #ff4747, #dc2626); color: #fff; display: flex; align-items: center; justify-content: space-between;">
        <div style="display: flex; align-items: center; gap: 10px;">
          <div style="width: 10px; height: 10px; background: #22c55e; border-radius: 50%;"></div>
          <span style="font-weight: bold; font-size: 15px;">Trợ Lý Ảo SHOPTQ4 🤖</span>
        </div>
        <button onclick="toggleAiChatboxV2()" style="background: none; border: none; color: #fff; cursor: pointer; font-size: 16px;"><i class="fas fa-times"></i></button>
      </div>

      <div id="ai-chat-messages" style="flex: 1; padding: 16px; overflow-y: auto; background: #f8fafc; display: flex; flex-direction: column; gap: 12px; font-size: 14px; line-height: 1.5; text-align: left;">
        <div style="align-self: flex-start; background: #fff; padding: 10px 14px; border-radius: 4px 12px 12px 12px; max-width: 80%; box-shadow: 0 2px 4px rgba(0,0,0,0.02); color: #334155; border: 1px solid #f1f5f9;">
  Hello anh em! 🔥 Tôi là trợ lý tự động của ShopTQ4. Anh em cần hỗ trợ nhanh hãy thử gõ các từ khóa: <b>zalo</b>, <b>nạp tiền</b>, <b>uy tín</b> hoặc <b>acc</b> nhé!
</div>
      </div>

      <div style="padding: 12px; background: #fff; border-top: 1px solid #e2e8f0; display: flex; gap: 8px;">
        <input type="text" id="ai-chat-input" placeholder="Nhập tin nhắn tại đây..." style="flex: 1; padding: 10px 14px; border: 1px solid #cbd5e1; border-radius: 20px; outline: none; font-size: 13px;" onkeypress="if(event.keyCode===13) thực_hiện_gửi_tin_nhắn_ai()">
        <button onclick="thực_hiện_gửi_tin_nhắn_ai()" style="background: #ff4747; color: #fff; border: none; width: 36px; height: 36px; border-radius: 50%; cursor: pointer; display: flex; align-items: center; justify-content: center;"><i class="fas fa-paper-plane" style="font-size: 14px;"></i></button>
      </div>
    </div>

    <button id="ai-chat-main-btn" onclick="toggleAiChatboxV2()" title="Chat với Trợ Lý AI" 
            style="width: 45px; height: 45px; border-radius: 50%; background: linear-gradient(135deg, #ff4747, #dc2626); border: none; box-shadow: 0 4px 15px rgba(220, 38, 38, 0.4); display: flex; align-items: center; justify-content: center; cursor: pointer;">
      <i class="fas fa-robot" style="color: #fff; font-size: 20px;"></i>
    </button>
  </div>

  <script>
    function toggleAiChatboxV2() {
      const chatbox = document.getElementById("ai-chatbox-window");
      chatbox.style.display = (chatbox.style.display === "none" || chatbox.style.display === "") ? "flex" : "none";
    }

    function thực_hiện_gửi_tin_nhắn_ai() {
      const input = document.getElementById("ai-chat-input");
      const messageText = input.value.trim();
      if (!messageText) return;

      input.value = "";
      const messagesContainer = document.getElementById("ai-chat-messages");

      // 1. Hiển thị tin nhắn của Khách
      const userBox = document.createElement("div");
      userBox.style = "align-self: flex-end; background: #ff4747; color: #fff; padding: 10px 14px; border-radius: 12px 4px 12px 12px; max-width: 80%; margin-left: auto; text-align: left;";
      userBox.innerText = messageText;
      messagesContainer.appendChild(userBox);
      messagesContainer.scrollTop = messagesContainer.scrollHeight;

      // 2. Tạo trạng thái chờ
      const loadingBox = document.createElement("div");
      loadingBox.id = "ai-loading-status";
      loadingBox.style = "align-self: flex-start; background: #e2e8f0; padding: 10px 14px; border-radius: 4px 12px 12px 12px; color: #64748b; font-style: italic;";
      loadingBox.innerHTML = "<i class='fas fa-spinner fa-spin'></i> Đang kết nối server...";
      messagesContainer.appendChild(loadingBox);
      messagesContainer.scrollTop = messagesContainer.scrollHeight;

      // 3. Sử dụng XMLHttpRequest (Ajax nguyên bản) để bỏ qua hoàn toàn cache trình duyệt
      const xhr = new XMLHttpRequest();
      xhr.open("POST", window.location.origin + "/api/ai-chat", true);
      xhr.setRequestHeader("Content-Type", "application/json");
      xhr.setRequestHeader("X-CSRF-TOKEN", document.querySelector('meta[name="csrf-token"]').getAttribute('content'));
      
      xhr.onreadystatechange = function () {
        if (xhr.readyState === 4) {
          // ÉP HỆ THỐNG XÓA HỘP THOẠI "ĐANG KẾT NỐI SERVER" NGAY LẬP TỨC
          const loader = document.getElementById("ai-loading-status");
          if (loader) {
            loader.parentNode.removeChild(loader);
          }

          const messagesContainer = document.getElementById("ai-chat-messages");
          const aiBox = document.createElement("div");
          aiBox.style = "align-self: flex-start; background: #fff; padding: 10px 14px; border-radius: 4px 12px 12px 12px; max-width: 80%; box-shadow: 0 2px 4px rgba(0,0,0,0.02); color: #334155; border: 1px solid #f1f5f9; text-align: left;";

          if (xhr.status === 200) {
            try {
              const data = JSON.parse(xhr.responseText);
              aiBox.innerText = data.reply;
            } catch (e) {
              aiBox.innerText = "🤖 Trợ lý AI đang xử lý dữ liệu, bạn nhắn lại câu khác nhé!";
            }
          } else {
            aiBox.innerText = "❌ Kết nối gián đoạn (Mã lỗi: " + xhr.status + "). Bạn thử gửi lại xem nhé!";
          }

          messagesContainer.appendChild(aiBox);
          messagesContainer.scrollTop = messagesContainer.scrollHeight;
        }
      };

      xhr.send(JSON.stringify({ message: messageText }));
    }
  </script>
  </body>

</html>