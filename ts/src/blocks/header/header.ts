const nav = document.querySelector('.header__nav')
const navBtn = document.querySelector('.header__nav-btn')

navBtn?.addEventListener('click', () => {
  nav?.classList.toggle('active')
})

document.addEventListener('click', (e) => {
  const target = e.target as HTMLElement
  if (!target.closest('.header')) {
    nav?.classList.remove('active')
  }
})
