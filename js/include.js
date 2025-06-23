function includeHTML() {
  const elements = document.querySelectorAll('[data-include]');
  elements.forEach(async (el) => {
    const file = el.getAttribute('data-include');
    if (file) {
      try {
        const res = await fetch(file);
        const html = await res.text();
        el.outerHTML = html;

        // Wait a moment, then run scripts
        setTimeout(() => {
          initStickyHeader();
          injectArrowIcons();
        }, 50);

      } catch (err) {
        el.innerHTML = `<div style="color:red">Error loading ${file}</div>`;
      }
    }
  });
}

// Sticky Navigation Script
// function initStickyHeader() {
//   const nav = document.getElementById('main-nav');
//   const signInBtn = document.getElementById('sign-in-btn');

//   if (!nav) return;

//   if (signInBtn) {
//     signInBtn.classList.add('hover:text-[#EDE8E1]');
//   }

//   window.addEventListener('scroll', () => {
//     if (window.scrollY > 10) {
//       nav.classList.add('bg-[#F0EAE3]', 'text-[#3B3D34]', 'border-b', 'border-[#BAAE9F]');
//       nav.classList.remove('bg-black/50', 'text-[#EDE8E1]');
//       if (signInBtn) {
//         signInBtn.classList.add('text-[#3B3D34]', 'border', 'border-[#D7D0C4]');
//         signInBtn.classList.remove('text-[#EDE8E1]');
//       }
//     } else {
//       nav.classList.remove('bg-[#F0EAE3]', 'text-[#3B3D34]', 'border-b', 'border-[#BAAE9F]');
//       nav.classList.add('bg-black/50', 'text-[#EDE8E1]');
//       if (signInBtn) {
//         signInBtn.classList.remove('text-[#3B3D34]');
//         signInBtn.classList.add('text-[#EDE8E1]');
//       }
//     }
//   });
// }

// Icon Animation Script
function injectArrowIcons() {
  const iconHTML = `
    <span class="absolute inset-0 transition-all duration-300 ease-in-out group-hover:-translate-y-2 group-hover:translate-x-2 group-hover:opacity-0 z-10">
        <svg class="inline-block w-2 h-2" width="8" height="7" viewBox="0 0 8 7" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M7.47945 0.19454L2.48692 0.19454C2.38845 0.194539 2.29093 0.213935 2.19995 0.251621C2.10897 0.289306 2.02631 0.344542 1.95667 0.414176C1.88704 0.483809 1.8318 0.566476 1.79412 0.657456C1.75643 0.748437 1.73704 0.845949 1.73704 0.944426C1.73704 1.0429 1.75643 1.14042 1.79412 1.2314C1.8318 1.32238 1.88704 1.40504 1.95667 1.47468C2.02631 1.54431 2.10897 1.59955 2.19995 1.63723C2.29093 1.67492 2.38845 1.69431 2.48692 1.69431L4.91902 1.69431L0.895932 5.7174C0.75528 5.85805 0.676262 6.04882 0.676262 6.24773C0.676262 6.44664 0.75528 6.6374 0.895932 6.77806C1.03658 6.91871 1.22735 6.99773 1.42626 6.99773C1.62517 6.99773 1.81594 6.91871 1.95659 6.77806L5.97968 2.75497L5.97968 5.18707C5.97939 5.28562 5.9986 5.38326 6.03618 5.47437C6.07377 5.56548 6.12899 5.64826 6.19868 5.71795C6.26837 5.78764 6.35115 5.84286 6.44226 5.88045C6.53337 5.91803 6.63101 5.93724 6.72956 5.93695C6.92844 5.93692 7.11916 5.85791 7.25978 5.71728C7.4004 5.57666 7.47942 5.38594 7.47945 5.18707L7.47945 0.19454Z" fill="#F0EAE3"/>
        </svg>
    </span>
    <span class="absolute inset-0 translate-y-2 -translate-x-2 opacity-0 transition-all duration-300 ease-in-out group-hover:translate-y-0 group-hover:translate-x-0 group-hover:opacity-100 z-20">
        <svg class="inline-block w-2 h-2" width="8" height="7" viewBox="0 0 8 7" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M7.47945 0.19454L2.48692 0.19454C2.38845 0.194539 2.29093 0.213935 2.19995 0.251621C2.10897 0.289306 2.02631 0.344542 1.95667 0.414176C1.88704 0.483809 1.8318 0.566476 1.79412 0.657456C1.75643 0.748437 1.73704 0.845949 1.73704 0.944426C1.73704 1.0429 1.75643 1.14042 1.79412 1.2314C1.8318 1.32238 1.88704 1.40504 1.95667 1.47468C2.02631 1.54431 2.10897 1.59955 2.19995 1.63723C2.29093 1.67492 2.38845 1.69431 2.48692 1.69431L4.91902 1.69431L0.895932 5.7174C0.75528 5.85805 0.676262 6.04882 0.676262 6.24773C0.676262 6.44664 0.75528 6.6374 0.895932 6.77806C1.03658 6.91871 1.22735 6.99773 1.42626 6.99773C1.62517 6.99773 1.81594 6.91871 1.95659 6.77806L5.97968 2.75497L5.97968 5.18707C5.97939 5.28562 5.9986 5.38326 6.03618 5.47437C6.07377 5.56548 6.12899 5.64826 6.19868 5.71795C6.26837 5.78764 6.35115 5.84286 6.44226 5.88045C6.53337 5.91803 6.63101 5.93724 6.72956 5.93695C6.92844 5.93692 7.11916 5.85791 7.25978 5.71728C7.4004 5.57666 7.47942 5.38594 7.47945 5.18707L7.47945 0.19454Z" fill="#F0EAE3"/>
        </svg>
    </span>
  `;

  document.querySelectorAll(".arrow-animation").forEach(el => {
    el.innerHTML = iconHTML;
  });
}

document.addEventListener('DOMContentLoaded', includeHTML);

