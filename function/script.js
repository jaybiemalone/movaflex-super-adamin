const contents = document.querySelectorAll('.content');

const observer = new IntersectionObserver((entries) => {
  entries.forEach(entry => {
    if (entry.isIntersecting) {
      entry.target.classList.add('show');
    } else {
      entry.target.classList.remove('show'); // Optional for repeat animations
    }
  });
}, { threshold: 0.2 });

contents.forEach(content => observer.observe(content));
