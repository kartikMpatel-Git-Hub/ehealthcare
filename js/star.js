const stars = document.querySelectorAll('.star');
const ratingMessage = document.getElementById('rating-message');

stars.forEach(star => {
  star.addEventListener('click', rateStar);
});

function rateStar(e) {
  const rating = parseInt(e.target.getAttribute('data-value'));
  document.cookie="rating="+rating;
  const starsContainer = e.target.parentElement;
  starsContainer.setAttribute('data-rating', rating);
  ratingMessage.textContent = `You rated ${rating} stars.`;
  
  // Update color of stars
  stars.forEach((star, index) => {
    if (index < rating) {
      star.style.color = '#FFD700';
    } else {
      star.style.color = '#ccc';
    }
  });
}
