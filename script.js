document.addEventListener("DOMContentLoaded", function () {
  // Navbar scroll effect
  const navbar = document.querySelector(".navbar");
  window.addEventListener("scroll", () => {
    if (window.scrollY > 50) {
      navbar.classList.add("scrolled");
    } else {
      navbar.classList.remove("scrolled");
    }
  });

  // Countdown logic (existing)
  function updateCountdown() {
    const countdowns = document.querySelectorAll(".countdown");
    countdowns.forEach((countdown) => {
      const targetTime = new Date(countdown.dataset.time).getTime();
      const now = new Date().getTime();
      const distance = targetTime - now;

      const days = Math.floor(distance / (1000 * 60 * 60 * 24));
      const hours = Math.floor(
        (distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60)
      );
      const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
      const seconds = Math.floor((distance % (1000 * 60)) / 1000);

      const daysSpan = countdown.querySelector(".days");
      const hoursSpan = countdown.querySelector(".hours");
      const minutesSpan = countdown.querySelector(".minutes");
      const secondsSpan = countdown.querySelector(".seconds");

      if (distance < 0) {
        countdown.innerHTML = "Tersedia Sekarang!";
        countdown.classList.add("expired");
      } else {
        if (daysSpan) daysSpan.textContent = String(days).padStart(2, "0");
        if (hoursSpan) hoursSpan.textContent = String(hours).padStart(2, "0");
        if (minutesSpan)
          minutesSpan.textContent = String(minutes).padStart(2, "0");
        if (secondsSpan)
          secondsSpan.textContent = String(seconds).padStart(2, "0");
      }
    });
  }

  // Update countdown every 1 second
  setInterval(updateCountdown, 1000);
  // Initial call to display countdown immediately
  updateCountdown();

  // --- New JavaScript for Login Modal ---
  const profileLink = document.getElementById("profileLink");
  const loginModal = document.getElementById("loginModal");
  const closeButton = document.querySelector(".close-button");

  // Show modal when profile link is clicked
  if (profileLink) {
    profileLink.addEventListener("click", function (event) {
      event.preventDefault(); // Prevent default link behavior (e.g., navigating to #)
      loginModal.classList.add("show");
    });
  }

  // Hide modal when close button is clicked
  if (closeButton) {
    closeButton.addEventListener("click", function () {
      loginModal.classList.remove("show");
    });
  }

  // Hide modal when clicking outside the modal content
  if (loginModal) {
    loginModal.addEventListener("click", function (event) {
      if (event.target === loginModal) {
        // Only close if clicking on the overlay itself
        loginModal.classList.remove("show");
      }
    });
  }

  // Handle login form submission (placeholder for actual login logic)
  const loginForm = document.querySelector(".login-form");
  if (loginForm) {
    loginForm.addEventListener("submit", function (event) {
      event.preventDefault(); // Prevent default form submission
      // In a real application, you would send this data to a backend
      const username = document.getElementById("username").value;
      const password = document.getElementById("password").value;

      console.log("Login attempt:", { username, password });
      // Simulate successful login and redirect to profile page
      // In a real app, check credentials with backend first
      alert("Login berhasil! Mengarahkan ke halaman profil...");
      window.location.href = "profile.html"; // Redirect to the profile page
    });
  }

  // --- End New JavaScript for Login Modal ---
});

document.addEventListener("DOMContentLoaded", function () {
  // Navbar scroll effect
  const navbar = document.querySelector(".navbar");
  window.addEventListener("scroll", () => {
    if (window.scrollY > 50) {
      navbar.classList.add("scrolled");
    } else {
      navbar.classList.remove("scrolled");
    }
  });

  // Countdown logic (existing)
  function updateCountdown() {
    const countdowns = document.querySelectorAll(".countdown");
    countdowns.forEach((countdown) => {
      const targetTime = new Date(countdown.dataset.time).getTime();
      const now = new Date().getTime();
      const distance = targetTime - now;

      const days = Math.floor(distance / (1000 * 60 * 60 * 24));
      const hours = Math.floor(
        (distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60)
      );
      const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
      const seconds = Math.floor((distance % (1000 * 60)) / 1000);

      const daysSpan = countdown.querySelector(".days");
      const hoursSpan = countdown.querySelector(".hours");
      const minutesSpan = countdown.querySelector(".minutes");
      const secondsSpan = countdown.querySelector(".seconds");

      if (distance < 0) {
        countdown.innerHTML = "Tersedia Sekarang!";
        countdown.classList.add("expired");
      } else {
        if (daysSpan) daysSpan.textContent = String(days).padStart(2, "0");
        if (hoursSpan) hoursSpan.textContent = String(hours).padStart(2, "0");
        if (minutesSpan)
          minutesSpan.textContent = String(minutes).padStart(2, "0");
        if (secondsSpan)
          secondsSpan.textContent = String(seconds).padStart(2, "0");
      }
    });
  }

  // Update countdown every 1 second
  setInterval(updateCountdown, 1000);
  // Initial call to display countdown immediately
  updateCountdown();

  // --- New JavaScript for Login Modal ---
  const profileLink = document.getElementById("profileLink");
  const loginModal = document.getElementById("loginModal");
  const closeButton = document.querySelector(".close-button");

  // Show modal when profile link is clicked
  if (profileLink) {
    profileLink.addEventListener("click", function (event) {
      event.preventDefault(); // Prevent default link behavior (e.g., navigating to #)
      loginModal.classList.add("show");
    });
  }

  // Hide modal when close button is clicked
  if (closeButton) {
    closeButton.addEventListener("click", function () {
      loginModal.classList.remove("show");
    });
  }

  // Hide modal when clicking outside the modal content
  if (loginModal) {
    loginModal.addEventListener("click", function (event) {
      if (event.target === loginModal) {
        // Only close if clicking on the overlay itself
        loginModal.classList.remove("show");
      }
    });
  }

  // Handle login form submission (placeholder for actual login logic)
  const loginForm = document.querySelector(".login-form");
  if (loginForm) {
    loginForm.addEventListener("submit", function (event) {
      event.preventDefault(); // Prevent default form submission
      // In a real application, you would send this data to a backend
      const username = document.getElementById("username").value;
      const password = document.getElementById("password").value;

      console.log("Login attempt:", { username, password });
      // Simulate successful login and redirect to profile page
      // In a real app, check credentials with backend first
      alert("Login berhasil! Mengarahkan ke halaman profil...");
      window.location.href = "profile.html"; // Redirect to the profile page
    });
  }

  // --- End New JavaScript for Login Modal ---
});

//bagian login form
document.addEventListener("DOMContentLoaded", function () {
  // Navbar scroll effect
  const navbar = document.querySelector(".navbar");
  window.addEventListener("scroll", () => {
    if (window.scrollY > 50) {
      navbar.classList.add("scrolled");
    } else {
      navbar.classList.remove("scrolled");
    }
  });

  // Countdown logic (existing)
  function updateCountdown() {
    const countdowns = document.querySelectorAll(".countdown");
    countdowns.forEach((countdown) => {
      const targetTime = new Date(countdown.dataset.time).getTime();
      const now = new Date().getTime();
      const distance = targetTime - now;

      const days = Math.floor(distance / (1000 * 60 * 60 * 24));
      const hours = Math.floor(
        (distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60)
      );
      const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
      const seconds = Math.floor((distance % (1000 * 60)) / 1000);

      const daysSpan = countdown.querySelector(".days");
      const hoursSpan = countdown.querySelector(".hours");
      const minutesSpan = countdown.querySelector(".minutes");
      const secondsSpan = countdown.querySelector(".seconds");

      if (distance < 0) {
        countdown.innerHTML = "Tersedia Sekarang!";
        countdown.classList.add("expired");
      } else {
        if (daysSpan) daysSpan.textContent = String(days).padStart(2, "0");
        if (hoursSpan) hoursSpan.textContent = String(hours).padStart(2, "0");
        if (minutesSpan)
          minutesSpan.textContent = String(minutes).padStart(2, "0");
        if (secondsSpan)
          secondsSpan.textContent = String(seconds).padStart(2, "0");
      }
    });
  }

  // Update countdown every 1 second
  setInterval(updateCountdown, 1000);
  // Initial call to display countdown immediately
  updateCountdown();

  // --- New JavaScript for Login Modal ---
  const profileLink = document.getElementById("profileLink");
  const loginModal = document.getElementById("loginModal");
  const closeButton = document.querySelector(".close-button");

  // Show modal when profile link is clicked
  if (profileLink) {
    profileLink.addEventListener("click", function (event) {
      event.preventDefault(); // Prevent default link behavior (e.g., navigating to #)
      loginModal.classList.add("show");
    });
  }

  // Hide modal when close button is clicked
  if (closeButton) {
    closeButton.addEventListener("click", function () {
      loginModal.classList.remove("show");
    });
  }

  // Hide modal when clicking outside the modal content
  if (loginModal) {
    loginModal.addEventListener("click", function (event) {
      if (event.target === loginModal) {
        // Only close if clicking on the overlay itself
        loginModal.classList.remove("show");
      }
    });
  }

  // Handle login form submission (placeholder for actual login logic)
  const loginForm = document.querySelector(".login-form");
  if (loginForm) {
    loginForm.addEventListener("submit", function (event) {
      event.preventDefault(); // Prevent default form submission
      // In a real application, you would send this data to a backend
      const username = document.getElementById("username").value;
      const password = document.getElementById("password").value;

      console.log("Login attempt:", { username, password });
      // Simulate successful login and redirect to profile page
      // In a real app, check credentials with backend first
      alert("Login berhasil! Mengarahkan ke halaman profil...");
      window.location.href = "profile.html"; // Redirect to the profile page
    });
  }

  // --- End New JavaScript for Login Modal ---
});
