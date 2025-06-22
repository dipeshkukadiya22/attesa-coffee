function includeHTML() {
  const includes = document.querySelectorAll('[data-include]');
  includes.forEach(async (el) => {
    const file = el.getAttribute('data-include');
    const res = await fetch(file);
    if (res.ok) {
      const html = await res.text();
      el.innerHTML = html;
    } else {
      el.innerHTML = "Component not found.";
    }
  });
}
document.addEventListener("DOMContentLoaded", includeHTML);