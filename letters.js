// Wrap letters of elements with class 'animate-letters' in spans so they can animate
document.addEventListener('DOMContentLoaded', function(){
  document.querySelectorAll('.animate-letters').forEach(function(el){
    const text = el.textContent.trim();
    el.textContent = '';
    Array.from(text).forEach(function(ch, i){
      const span = document.createElement('span');
      span.textContent = ch === ' ' ? '\u00A0' : ch;
      span.style.setProperty('--i', i);
      el.appendChild(span);
    });
  });
});
