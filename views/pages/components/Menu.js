const Menu = (text, icon = false) => {
    const menuElement = document.createElement('li')
    menuElement.className = "nav-item"
    if (!icon){
        icon = `<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bookmark-fill" viewBox="0 0 16 16">
  <path d="M2 2v13.5a.5.5 0 0 0 .74.439L8 13.069l5.26 2.87A.5.5 0 0 0 14 15.5V2a2 2 0 0 0-2-2H4a2 2 0 0 0-2 2z"/>
</svg>`;
    }

    menuElement.innerHTML = `<span class="nav-link">
          <span class="sidebar-icon icon-lg">
            ${icon}
          </span>
          <span class="sidebar-text">${text}</span>
        </span>`

    return menuElement
}

export default Menu;