/**
 * Topbar Menu Enhancement
 * Handles mobile interactions, keyboard navigation, and accessibility
 */

class TopbarMenu {
  constructor() {
    this.menu = document.querySelector('.main-menu')
    this.menuItems = document.querySelectorAll('.menu-item-has-children')
    this.isMobile = window.innerWidth <= 768

    this.init()
  }

  init() {
    this.setupEventListeners()
    this.setupAccessibility()
    this.handleResize()
  }

  setupEventListeners() {
    // Handle clicks for mobile submenu toggle
    this.menuItems.forEach((item) => {
      const link = item.querySelector('.menu-link')
      const submenu = item.querySelector('.sub-menu')

      if (submenu) {
        // Mobile click handling
        link.addEventListener('click', (e) => {
          if (this.isMobile) {
            e.preventDefault()
            this.toggleSubmenu(item)
          }
        })

        // Keyboard navigation
        link.addEventListener('keydown', (e) => {
          this.handleKeydown(e, item)
        })

        // Close submenu when clicking outside
        document.addEventListener('click', (e) => {
          if (!item.contains(e.target)) {
            this.closeSubmenu(item)
          }
        })
      }
    })

    // Handle window resize
    window.addEventListener('resize', () => {
      this.handleResize()
    })

    // Handle escape key to close all submenus
    document.addEventListener('keydown', (e) => {
      if (e.key === 'Escape') {
        this.closeAllSubmenus()
      }
    })
  }

  setupAccessibility() {
    this.menuItems.forEach((item) => {
      const link = item.querySelector('.menu-link')
      const submenu = item.querySelector('.sub-menu')

      if (submenu) {
        // Add ARIA attributes
        link.setAttribute('aria-haspopup', 'true')
        link.setAttribute('aria-expanded', 'false')
        submenu.setAttribute('role', 'menu')

        // Add unique IDs for better accessibility
        const submenuId = `submenu-${Math.random().toString(36).substr(2, 9)}`
        submenu.setAttribute('id', submenuId)
        link.setAttribute('aria-controls', submenuId)

        // Setup submenu items
        const submenuItems = submenu.querySelectorAll('.submenu-link')
        submenuItems.forEach((submenuItem) => {
          submenuItem.setAttribute('role', 'menuitem')
          submenuItem.setAttribute('tabindex', '-1')
        })
      }
    })
  }

  toggleSubmenu(item) {
    const isOpen = item.classList.contains('open')

    // Close all other submenus first
    this.closeAllSubmenus()

    if (!isOpen) {
      this.openSubmenu(item)
    }
  }

  openSubmenu(item) {
    const link = item.querySelector('.menu-link')
    const submenu = item.querySelector('.sub-menu')

    item.classList.add('open')
    link.setAttribute('aria-expanded', 'true')

    // Focus first submenu item
    const firstSubmenuItem = submenu.querySelector('.submenu-link')
    if (firstSubmenuItem) {
      firstSubmenuItem.setAttribute('tabindex', '0')
    }
  }

  closeSubmenu(item) {
    const link = item.querySelector('.menu-link')
    const submenu = item.querySelector('.sub-menu')

    item.classList.remove('open')
    link.setAttribute('aria-expanded', 'false')

    // Reset tabindex for submenu items
    if (submenu) {
      const submenuItems = submenu.querySelectorAll('.submenu-link')
      submenuItems.forEach((submenuItem) => {
        submenuItem.setAttribute('tabindex', '-1')
      })
    }
  }

  closeAllSubmenus() {
    this.menuItems.forEach((item) => {
      this.closeSubmenu(item)
    })
  }

  handleKeydown(e, item) {
    const submenu = item.querySelector('.sub-menu')

    if (!submenu) return

    switch (e.key) {
      case 'Enter':
      case ' ':
        e.preventDefault()
        this.toggleSubmenu(item)
        break
      case 'ArrowDown':
        e.preventDefault()
        this.openSubmenu(item)
        this.focusFirstSubmenuItem(submenu)
        break
      case 'ArrowUp':
        e.preventDefault()
        this.openSubmenu(item)
        this.focusLastSubmenuItem(submenu)
        break
    }
  }

  focusFirstSubmenuItem(submenu) {
    const firstItem = submenu.querySelector('.submenu-link')
    if (firstItem) {
      firstItem.focus()
    }
  }

  focusLastSubmenuItem(submenu) {
    const submenuItems = submenu.querySelectorAll('.submenu-link')
    const lastItem = submenuItems[submenuItems.length - 1]
    if (lastItem) {
      lastItem.focus()
    }
  }

  handleResize() {
    const wasMobile = this.isMobile
    this.isMobile = window.innerWidth <= 768

    // If switching from mobile to desktop, close all submenus
    if (wasMobile && !this.isMobile) {
      this.closeAllSubmenus()
    }
  }

  // Public method to refresh menu (useful after AJAX updates)
  refresh() {
    this.menuItems = document.querySelectorAll('.menu-item-has-children')
    this.setupAccessibility()
  }
}

// Auto-initialize when DOM is ready
document.addEventListener('DOMContentLoaded', () => {
  if (document.querySelector('.main-menu')) {
    window.topbarMenu = new TopbarMenu()
  }
})

// Export for manual initialization if needed
export default TopbarMenu
