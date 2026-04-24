<div class="row" id="user-stats">
  <!-- Total Space -->
  <div class="col-sm-6 col-xl-3 mb-3">
    <div class="card custom-card hrm-main-card primary">
      <div class="card-body">
        <div class="d-flex align-items-top">
          <div class="me-3">
            <span class="avatar bg-primary">
              <i class="ri-server-line fs-18"></i>
            </span>
          </div>
          <div class="flex-fill">
            <span class="fw-semibold text-muted d-block mb-2">{{ __t('Total Space') }}</span>
            <h5 class="fw-semibold mb-2" id="stat-total-space">
              <span class="spinner-border spinner-border-sm" role="status"></span>
            </h5>
            <small class="text-muted" id="stat-disk-path">Loading...</small>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Used Space -->
  <div class="col-sm-6 col-xl-3 mb-3">
    <div class="card custom-card hrm-main-card danger">
      <div class="card-body">
        <div class="d-flex align-items-top">
          <div class="me-3">
            <span class="avatar bg-danger">
              <i class="ri-hard-drive-2-line fs-18"></i>
            </span>
          </div>
          <div class="flex-fill">
            <span class="fw-semibold text-muted d-block mb-2">{{ __t('Used Space') }}</span>
            <h5 class="fw-semibold mb-2" id="stat-used-space">
              <span class="spinner-border spinner-border-sm" role="status"></span>
            </h5>
            <div class="progress mt-2" style="height: 6px;">
              <div class="progress-bar bg-danger" id="disk-progress-bar" role="progressbar" style="width: 0%"></div>
            </div>
            <small class="text-muted mt-1" id="stat-disk-percent">0%</small>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Free Space -->
  <div class="col-sm-6 col-xl-3 mb-3">
    <div class="card custom-card hrm-main-card primary">
      <div class="card-body">
        <div class="d-flex align-items-top">
          <div class="me-3">
            <span class="avatar bg-info">
              <i class="ri-database-2-line fs-18"></i>
            </span>
          </div>
          <div class="flex-fill">
            <span class="fw-semibold text-muted d-block mb-2">{{ __t('Free Space') }}</span>
            <h5 class="fw-semibold mb-2" id="stat-free-space">
              <span class="spinner-border spinner-border-sm" role="status"></span>
            </h5>
            <small class="text-success" id="stat-free-percent">Available</small>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- CPU Usage -->
  <div class="col-sm-6 col-xl-3 mb-3">
    <div class="card custom-card hrm-main-card" id="cpu-card">
      <div class="card-body">
        <div class="d-flex align-items-top">
          <div class="me-3">
            <span class="avatar" id="cpu-avatar">
              <i class="ri-cpu-line fs-18"></i>
            </span>
          </div>
          <div class="flex-fill">
            <span class="fw-semibold text-muted d-block mb-2">{{ __t('CPU Load') }}</span>
            <h5 class="fw-semibold mb-2" id="stat-cpu-load">
              <span class="spinner-border spinner-border-sm" role="status"></span>
            </h5>
            <small class="text-muted" id="stat-cpu-cores">Loading...</small>
            <div class="progress mt-2" style="height: 6px;">
              <div class="progress-bar" id="cpu-progress-bar" role="progressbar" style="width: 0%"></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Memory Usage -->
  <div class="col-sm-6 col-xl-3 mb-3">
    <div class="card custom-card hrm-main-card" id="memory-card">
      <div class="card-body">
        <div class="d-flex align-items-top">
          <div class="me-3">
            <span class="avatar" id="memory-avatar">
              <i class="ri-dashboard-line fs-18"></i>
            </span>
          </div>
          <div class="flex-fill">
            <span class="fw-semibold text-muted d-block mb-2">{{ __t('Memory Usage') }}</span>
            <h5 class="fw-semibold mb-2" id="stat-memory-used">
              <span class="spinner-border spinner-border-sm" role="status"></span>
            </h5>
            <small class="text-muted" id="stat-memory-detail">Loading...</small>
            <div class="progress mt-2" style="height: 6px;">
              <div class="progress-bar" id="memory-progress-bar" role="progressbar" style="width: 0%"></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Disk I/O -->
  <div class="col-sm-6 col-xl-3 mb-3">
    <div class="card custom-card hrm-main-card warning">
      <div class="card-body">
        <div class="d-flex align-items-top">
          <div class="me-3">
            <span class="avatar bg-warning">
              <i class="ri-swap-line fs-18"></i>
            </span>
          </div>
          <div class="flex-fill">
            <span class="fw-semibold text-muted d-block mb-2">{{ __t('Disk I/O') }}</span>
            <h5 class="fw-semibold mb-2" id="stat-disk-io">
              <span class="spinner-border spinner-border-sm" role="status"></span>
            </h5>
            <small class="text-muted" id="stat-disk-io-detail">Collecting baseline...</small>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Health Status -->
  <div class="col-sm-6 col-xl-3 mb-3">
    <div class="card custom-card hrm-main-card" id="health-card">
      <div class="card-body">
        <div class="d-flex align-items-top">
          <div class="me-3">
            <span class="avatar" id="health-avatar">
              <i class="ri-heart-pulse-line fs-18"></i>
            </span>
          </div>
          <div class="flex-fill">
            <span class="fw-semibold text-muted d-block mb-2">{{ __t('Health Score') }}</span>
            <h5 class="fw-semibold mb-2" id="stat-health-score">
              <span class="spinner-border spinner-border-sm" role="status"></span>
            </h5>
            <small id="stat-health-status">Checking...</small>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Environment Info -->
  <div class="col-sm-6 col-xl-3 mb-3">
    <div class="card custom-card hrm-main-card secondary">
      <div class="card-body">
        <div class="d-flex align-items-top">
          <div class="me-3">
            <span class="avatar bg-secondary">
              <i class="ri-information-line fs-18"></i>
            </span>
          </div>
          <div class="flex-fill">
            <span class="fw-semibold text-muted d-block mb-2">{{ __t('Environment') }}</span>
            <h5 class="fw-semibold mb-2" id="stat-environment" style="font-size: 14px;">
              <span class="spinner-border spinner-border-sm" role="status"></span>
            </h5>
            <small class="text-muted" id="stat-cache-driver">Loading...</small>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- PHP & System Info Row -->
<div class="row" id="php-system-info">
  <!-- PHP Version -->
  <div class="col-sm-6 col-xl-3 mb-3">
    <div class="card custom-card hrm-main-card info">
      <div class="card-body">
        <div class="d-flex align-items-top">
          <div class="me-3">
            <span class="avatar bg-info">
              <i class="ri-code-s-slash-line fs-18"></i>
            </span>
          </div>
          <div class="flex-fill">
            <span class="fw-semibold text-muted d-block mb-2">{{ __t('PHP Version') }}</span>
            <h5 class="fw-semibold mb-2" id="stat-php-version">
              <span class="spinner-border spinner-border-sm" role="status"></span>
            </h5>
            <small class="text-muted" id="stat-php-sapi">Loading...</small>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- PHP Memory Limit -->
  <div class="col-sm-6 col-xl-3 mb-3">
    <div class="card custom-card hrm-main-card primary">
      <div class="card-body">
        <div class="d-flex align-items-top">
          <div class="me-3">
            <span class="avatar bg-primary">
              <i class="ri-file-code-line fs-18"></i>
            </span>
          </div>
          <div class="flex-fill">
            <span class="fw-semibold text-muted d-block mb-2">{{ __t('PHP Memory') }}</span>
            <h5 class="fw-semibold mb-2" id="stat-php-memory-used">
              <span class="spinner-border spinner-border-sm" role="status"></span>
            </h5>
            <small class="text-muted" id="stat-php-memory-limit">Limit: Loading...</small>
            <div class="progress mt-2" style="height: 6px;">
              <div class="progress-bar bg-primary" id="php-memory-progress-bar" role="progressbar" style="width: 0%"></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- System RAM Details -->
  <div class="col-sm-6 col-xl-3 mb-3">
    <div class="card custom-card hrm-main-card" id="ram-detail-card">
      <div class="card-body">
        <div class="d-flex align-items-top">
          <div class="me-3">
            <span class="avatar" id="ram-detail-avatar">
              <i class="ri-server-line fs-18"></i>
            </span>
          </div>
          <div class="flex-fill">
            <span class="fw-semibold text-muted d-block mb-2">{{ __t('System RAM') }}</span>
            <h5 class="fw-semibold mb-2" id="stat-ram-used-mb">
              <span class="spinner-border spinner-border-sm" role="status"></span>
            </h5>
            <small class="text-muted" id="stat-ram-available">Available: Loading...</small>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- PHP Extensions/Modules -->
  <div class="col-sm-6 col-xl-3 mb-3">
    <div class="card custom-card hrm-main-card secondary">
      <div class="card-body">
        <div class="d-flex align-items-top">
          <div class="me-3">
            <span class="avatar bg-secondary">
              <i class="ri-puzzle-line fs-18"></i>
            </span>
          </div>
          <div class="flex-fill">
            <span class="fw-semibold text-muted d-block mb-2">{{ __t('PHP Extensions') }}</span>
            <h5 class="fw-semibold mb-2" id="stat-php-extensions">
              <span class="spinner-border spinner-border-sm" role="status"></span>
            </h5>
            <small class="text-muted" id="stat-php-extensions-detail">Loading...</small>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Health Alerts Section -->
<div class="row" id="health-alerts-section" style="display: none;">
  <div class="col-12 mb-3">
    <div class="card custom-card">
      <div class="card-header">
        <h5 class="card-title">🚨 System Alerts & Recommendations</h5>
      </div>
      <div class="card-body">
        <div id="health-alerts-content"></div>
      </div>
    </div>
  </div>
</div>
@push('styles')
  <style>
    /* Đồng nhất kích thước tất cả stat cards */
    #user-stats .card {
      height: 100%;
      min-height: 140px;
    }

    #user-stats .card-body {
      display: flex;
      flex-direction: column;
      justify-content: center;
      padding: 1.25rem;
    }

    #user-stats .col-sm-6 {
      display: flex;
    }

    /* Đảm bảo progress bar không làm card cao hơn */
    #user-stats .progress {
      margin-top: 0.5rem !important;
    }

    /* Giới hạn chiều cao text để không bị tràn */
    #user-stats h5 {
      margin-bottom: 0.5rem !important;
      white-space: nowrap;
      overflow: hidden;
      text-overflow: ellipsis;
    }

    #user-stats small {
      display: block;
      margin-top: 0.25rem;
      white-space: nowrap;
      overflow: hidden;
      text-overflow: ellipsis;
    }

    /* Avatar size đồng nhất */
    #user-stats .avatar {
      width: 2.5rem;
      height: 2.5rem;
      display: flex;
      align-items: center;
      justify-content: center;
    }
  </style>
@endpush

@push('scripts')
  <script>
    let systemMonitorInterval = null;
    let firstCallMade = false;

    // Hàm lấy class màu theo percentage
    function getStatusClass(percent) {
      if (percent >= 90) return 'danger';
      if (percent >= 70) return 'warning';
      return 'success';
    }

    // Hàm lấy class background
    function getStatusBgClass(percent) {
      if (percent >= 90) return 'bg-danger';
      if (percent >= 70) return 'bg-warning';
      return 'bg-success';
    }

    // Hàm fetch system info
    async function fetchSystemInfo() {
      try {
        const response = await axios.get('/api/system-monitor');
        const data = response.data;

        // Nếu lần đầu và disk I/O đang collect baseline
        if (!firstCallMade && data.diskIO && data.diskIO.note) {
          firstCallMade = true;
          // Gọi lại sau 2 giây
          setTimeout(fetchSystemInfo, 2000);
        }

        updateDashboard(data);

      } catch (error) {
        console.error('Error fetching system monitor:', error);

        // Show error in UI
        document.getElementById('stat-total-space').innerHTML =
          '<span class="text-danger">Error</span>';
      }
    }

    // Hàm update dashboard
    function updateDashboard(data) {
      // === DISK SPACE ===
      if (data.disk) {
        document.getElementById('stat-total-space').textContent = data.disk.totalGB + ' GB';
        document.getElementById('stat-used-space').textContent = data.disk.usedGB + ' GB';
        document.getElementById('stat-free-space').textContent = data.disk.freeGB + ' GB';
        document.getElementById('stat-disk-path').textContent = 'Path: ' + data.disk.path;

        const diskPercent = data.disk.usedPercent;
        document.getElementById('stat-disk-percent').textContent = diskPercent.toFixed(1) + '% used';

        const diskBar = document.getElementById('disk-progress-bar');
        diskBar.style.width = diskPercent + '%';
        diskBar.className = 'progress-bar ' + getStatusBgClass(diskPercent);

        document.getElementById('stat-free-percent').textContent =
          (100 - diskPercent).toFixed(1) + '% available';
      }

      // === CPU ===
      if (data.cpu) {
        const cores = data.cpu.cores || 1;
        const load = data.cpu.loadAvg ? data.cpu.loadAvg['1min'] : 0;
        const loadPercent = Math.min((load / cores) * 100, 100);

        document.getElementById('stat-cpu-load').textContent = load.toFixed(2);
        document.getElementById('stat-cpu-cores').textContent =
          cores + ' core(s) | Load: ' +
          (data.cpu.loadAvg ? `${data.cpu.loadAvg['1min']}/${data.cpu.loadAvg['5min']}/${data.cpu.loadAvg['15min']}` : 'N/A');

        const cpuBar = document.getElementById('cpu-progress-bar');
        cpuBar.style.width = loadPercent + '%';
        const cpuStatus = getStatusClass(loadPercent);
        cpuBar.className = 'progress-bar bg-' + cpuStatus;

        // Update card color
        const cpuCard = document.getElementById('cpu-card');
        cpuCard.className = 'card custom-card hrm-main-card ' + cpuStatus;

        const cpuAvatar = document.getElementById('cpu-avatar');
        cpuAvatar.className = 'avatar bg-' + cpuStatus;
      }

      // === MEMORY ===
      if (data.memory && data.memory.system) {
        const memPercent = data.memory.system.usedPercent;

        document.getElementById('stat-memory-used').textContent = memPercent.toFixed(1) + '%';
        document.getElementById('stat-memory-detail').textContent =
          `${data.memory.system.usedMB} MB / ${data.memory.system.totalMB} MB`;

        const memBar = document.getElementById('memory-progress-bar');
        memBar.style.width = memPercent + '%';
        const memStatus = getStatusClass(memPercent);
        memBar.className = 'progress-bar bg-' + memStatus;

        // Update card color
        const memCard = document.getElementById('memory-card');
        memCard.className = 'card custom-card hrm-main-card ' + memStatus;

        const memAvatar = document.getElementById('memory-avatar');
        memAvatar.className = 'avatar bg-' + memStatus;

        // === System RAM Details ===
        document.getElementById('stat-ram-used-mb').textContent =
          data.memory.system.usedMB + ' MB';
        document.getElementById('stat-ram-available').textContent =
          'Available: ' + data.memory.system.availableMB + ' MB';

        // Update RAM detail card color
        const ramCard = document.getElementById('ram-detail-card');
        ramCard.className = 'card custom-card hrm-main-card ' + memStatus;

        const ramAvatar = document.getElementById('ram-detail-avatar');
        ramAvatar.className = 'avatar bg-' + memStatus;
      }

      // === PHP MEMORY ===
      if (data.memory && data.memory.php) {
        const phpUsedMB = data.memory.php.usedMB;
        const phpLimitMB = data.memory.php.limitMB;
        const phpPeakMB = data.memory.php.peakMB;

        document.getElementById('stat-php-memory-used').textContent = phpUsedMB + ' MB';
        document.getElementById('stat-php-memory-limit').textContent =
          `Limit: ${phpLimitMB} | Peak: ${phpPeakMB} MB`;

        // Tính % nếu có limit
        let phpMemPercent = 0;
        if (phpLimitMB && phpLimitMB !== '-1' && phpLimitMB.toString().indexOf('M') !== -1) {
          const limitNum = parseInt(phpLimitMB);
          phpMemPercent = (phpUsedMB / limitNum) * 100;

          const phpMemBar = document.getElementById('php-memory-progress-bar');
          phpMemBar.style.width = phpMemPercent + '%';
          phpMemBar.className = 'progress-bar bg-' + getStatusClass(phpMemPercent);
        }
      }

      // === DISK I/O ===
      if (data.diskIO) {
        if (data.diskIO.note) {
          document.getElementById('stat-disk-io').innerHTML =
            '<i class="ri-loader-4-line ri-spin"></i>';
          document.getElementById('stat-disk-io-detail').textContent = data.diskIO.note;
        } else if (data.diskIO.error) {
          document.getElementById('stat-disk-io').innerHTML =
            '<span class="text-muted" style="font-size: 14px;">N/A</span>';
          document.getElementById('stat-disk-io-detail').textContent = data.diskIO.error;
        } else {
          // Tính tổng I/O
          let totalRead = 0;
          let totalWrite = 0;

          Object.values(data.diskIO).forEach(io => {
            if (io.read_kBps !== undefined) totalRead += io.read_kBps;
            if (io.write_kBps !== undefined) totalWrite += io.write_kBps;
          });

          const total = totalRead + totalWrite;
          document.getElementById('stat-disk-io').textContent = total.toFixed(2) + ' kB/s';
          document.getElementById('stat-disk-io-detail').innerHTML =
            `<span class="text-success">↓ ${totalRead.toFixed(2)}</span> / ` +
            `<span class="text-danger">↑ ${totalWrite.toFixed(2)}</span> kB/s`;
        }
      }

      // === HEALTH STATUS ===
      if (data.health) {
        const score = data.health.score;
        const status = data.health.status;

        document.getElementById('stat-health-score').textContent = score + '/100';

        let statusText = '✅ Healthy';
        let statusClass = 'success';

        if (status === 'critical') {
          statusText = '🔴 Critical';
          statusClass = 'danger';
        } else if (status === 'warning') {
          statusText = '🟡 Warning';
          statusClass = 'warning';
        }

        document.getElementById('stat-health-status').innerHTML =
          `<span class="text-${statusClass}">${statusText}</span>`;

        // Update card color
        const healthCard = document.getElementById('health-card');
        healthCard.className = 'card custom-card hrm-main-card ' + statusClass;

        const healthAvatar = document.getElementById('health-avatar');
        healthAvatar.className = 'avatar bg-' + statusClass;

        // Show alerts nếu có
        if (data.health.alerts && data.health.alerts.length > 0) {
          let alertsHTML = '<div class="alert alert-' + statusClass + '">';
          alertsHTML += '<h6 class="mb-2">⚠️ Alerts:</h6><ul class="mb-0">';

          data.health.alerts.forEach(alert => {
            alertsHTML += `<li>${alert}</li>`;
          });

          alertsHTML += '</ul></div>';

          if (data.health.recommendations && data.health.recommendations.length > 0) {
            alertsHTML += '<div class="alert alert-info mt-2">';
            alertsHTML += '<h6 class="mb-2">💡 Recommendations:</h6><ul class="mb-0">';

            data.health.recommendations.forEach(rec => {
              alertsHTML += `<li>${rec}</li>`;
            });

            alertsHTML += '</ul></div>';
          }

          document.getElementById('health-alerts-content').innerHTML = alertsHTML;
          document.getElementById('health-alerts-section').style.display = 'block';
        } else {
          document.getElementById('health-alerts-section').style.display = 'none';
        }
      }

      // === ENVIRONMENT ===
      if (data.environment) {
        const envText = data.environment.length > 25 ?
          data.environment.substring(0, 25) + '...' :
          data.environment;
        document.getElementById('stat-environment').textContent = envText;
        document.getElementById('stat-environment').title = data.environment;
      }

      if (data.cache_driver) {
        document.getElementById('stat-cache-driver').textContent =
          'Cache: ' + data.cache_driver.toUpperCase();
      }

      // === PHP INFO ===
      if (data.php) {
        // PHP Version
        document.getElementById('stat-php-version').textContent = data.php.version || 'Unknown';
        document.getElementById('stat-php-sapi').textContent =
          'SAPI: ' + (data.php.sapi || 'Unknown');

        // PHP Extensions
        if (data.php.extensions && data.php.extensions.count) {
          document.getElementById('stat-php-extensions').textContent =
            data.php.extensions.count + ' loaded';

          // Hiển thị một số extensions quan trọng
          if (data.php.extensions.important) {
            const importantExts = data.php.extensions.important.slice(0, 3).join(', ');
            document.getElementById('stat-php-extensions-detail').textContent = importantExts + '...';
          }
        }
      }
    }

    // Initialize khi DOM ready
    document.addEventListener('DOMContentLoaded', function() {
      console.log('🚀 System Monitor initialized');

      // First call
      fetchSystemInfo();

      // Auto refresh every 5 seconds
      systemMonitorInterval = setInterval(fetchSystemInfo, 5000);
    });

    // Cleanup khi rời trang
    window.addEventListener('beforeunload', function() {
      if (systemMonitorInterval) {
        clearInterval(systemMonitorInterval);
      }
    });
  </script>
@endpush
