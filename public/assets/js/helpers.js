// Simple Password Toggle Function
(function() {
  'use strict';

  // Password Toggle လုပ်မယ့် function
  function initPasswordToggle() {
    // .form-password-toggle i ရှိတဲ့ icon တွေအားလုံးကို ရှာမယ်
    const toggleIcons = document.querySelectorAll('.form-password-toggle i');
    
    if (!toggleIcons || toggleIcons.length === 0) return;
    
    // Icon တစ်ခုချင်းစီကို click event တပ်မယ်
    toggleIcons.forEach(function(icon) {
      icon.addEventListener('click', function(e) {
        e.preventDefault();
        
        // Password input field ကိုရှာမယ်
        const passwordContainer = icon.closest('.form-password-toggle');
        const passwordInput = passwordContainer.querySelector('input');
        
        // Input type ကို toggle လုပ်မယ်
        if (passwordInput.getAttribute('type') === 'password') {
          // Show password
          passwordInput.setAttribute('type', 'text');
          icon.classList.remove('ti-eye-off');
          icon.classList.add('ti-eye');
        } else {
          // Hide password
          passwordInput.setAttribute('type', 'password');
          icon.classList.remove('ti-eye');
          icon.classList.add('ti-eye-off');
        }
      });
    });
  }

  // Page load ပြီးရင် အလိုအလျောက် run မယ်
  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initPasswordToggle);
  } else {
    initPasswordToggle();
  }

})();