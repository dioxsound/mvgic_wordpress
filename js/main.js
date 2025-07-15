// ============ ГЛОБАЛЬНЫЕ ПЕРЕМЕННЫЕ ============
const header = document.querySelector('.header')
const background = document.querySelector('.background')
const galleryItems = document.querySelectorAll('.gallery__item')
const audio = document.getElementById('background-audio')
const muteButton = document.querySelector('.header__menu-button')

let lastScrollY = 0
let ticking = false

// ============ ВЫСОТА ШАПКИ ============
function updateHeaderHeight () {
  document.documentElement.style.setProperty(
    '--header-height',
    `${header.offsetHeight}px`
  )
}
updateHeaderHeight()
window.addEventListener('resize', updateHeaderHeight)

// ============ АНИМАЦИЯ ФОНА ============
function updateBlurSmooth () {
  const maxScroll = 300
  const maxBlur = 25
  const scroll = Math.min(window.scrollY, maxScroll)
  const blurValue = (scroll / maxScroll) * maxBlur
  if (background)
    background.style.setProperty('--blur-amount', `${blurValue}px`)
}
window.addEventListener('scroll', () => {
  requestAnimationFrame(updateBlurSmooth)
})

// ============ ГАЛЕРЕЯ ============
function initIntersectionObserver () {
  const observer = new IntersectionObserver(
    entries => {
      entries.forEach(entry => {
        const el = entry.target
        if (entry.isIntersecting) {
          el.classList.add('in-view')
          el.classList.remove('above', 'below')
        } else {
          const bounding = el.getBoundingClientRect()
          const viewportHeight = window.innerHeight
          if (bounding.top < 0) {
            el.classList.remove('in-view', 'below')
            el.classList.add('above')
          } else if (bounding.top > viewportHeight) {
            el.classList.remove('in-view', 'above')
            el.classList.add('below')
          } else {
            el.classList.remove('in-view', 'above', 'below')
          }
        }
      })
    },
    {
      threshold: 0,
      rootMargin: '10px 0px'
    }
  )

  document
    .querySelectorAll('.gallery__item')
    .forEach(item => observer.observe(item))
}
initIntersectionObserver()

// ============ АУДИО ============
if (audio && muteButton) {
  let audioPlaying = false

  muteButton.addEventListener('click', () => {
    if (!audioPlaying) {
      audio.play().catch(err => {
        console.warn('Play failed:', err)
      })
      audio.muted = false
      audioPlaying = true
      muteButton.textContent = 'Mute'
    } else {
      audio.muted = !audio.muted
      muteButton.textContent = audio.muted ? 'Play' : 'Mute'
    }
  })
}

// ============ ПОДМЕНЮ "КОНТАКТЫ" ============
document.addEventListener('DOMContentLoaded', function () {
  const headerMenuItems = document.querySelectorAll('.header__menu-item')
  const submenu = document.querySelector('.header__submenu')
  const closeBtn = document.querySelector('.header__submenu-button')

  if (!submenu || !closeBtn) return

  let contactsMenuItem = null
  headerMenuItems.forEach(item => {
    const link = item.querySelector('.header__menu-button')
    if (link && link.textContent.trim() === 'Contacts') {
      contactsMenuItem = item
    }
  })

  if (!contactsMenuItem) return

  contactsMenuItem.addEventListener('click', function (e) {
    e.stopPropagation()
    submenu.classList.add('open')
  })

  closeBtn.addEventListener('click', function (e) {
    e.stopPropagation()
    submenu.classList.remove('open')
  })

  document.addEventListener('click', function (e) {
    if (!submenu.contains(e.target) && !contactsMenuItem.contains(e.target)) {
      submenu.classList.remove('open')
    }
  })
})

// ============ AJAX-ПЕРЕХОДЫ ============
function isInternalLink (link) {
  const href = link.getAttribute('href')
  return (
    link.hostname === location.hostname &&
    !href.includes('#') &&
    !href.includes('wp-admin') &&
    !href.includes('wp-login') &&
    !link.target &&
    !link.closest('.no-ajax')
  )
}

function ajaxifyLinks () {
  const containers = ['header', 'footer', 'main']
  const selector = containers.map(sel => `${sel} a`).join(',')

  document.querySelectorAll(selector).forEach(link => {
    const href = link.getAttribute('href')
    
    if (
      !href ||
      link.hostname !== location.hostname ||
      href.includes('#') ||
      href.includes('wp-admin') ||
      href.includes('wp-login') ||
      link.target ||
      link.closest('.no-ajax')
    ) {
      return
    }

    link.addEventListener('click', function (e) {
      e.preventDefault()
      const url = this.href

      fetch(url)
        .then(res => res.text())
        .then(html => {
          const parser = new DOMParser()
          const doc = parser.parseFromString(html, 'text/html')
          const newMain = doc.querySelector('main')

          if (newMain) {
            document.querySelector('main').innerHTML = newMain.innerHTML
            window.history.pushState({}, '', url)

            initIntersectionObserver()
            updateHeaderHeight()
            ajaxifyLinks()
            window.scrollTo(0, 0)
          }
        })
        .catch(err => console.error('AJAX переход не удался', err))
    })
  })
}


ajaxifyLinks()

// ============ POPSTATE (назад / вперёд) ============
window.addEventListener('popstate', () => {
  fetch(location.href)
    .then(res => res.text())
    .then(html => {
      const parser = new DOMParser()
      const doc = parser.parseFromString(html, 'text/html')
      const newMain = doc.querySelector('main')
      if (newMain) {
        document.querySelector('main').innerHTML = newMain.innerHTML
        initIntersectionObserver()
        updateHeaderHeight()
        window.scrollTo(0, 0)
      }
    })
})
