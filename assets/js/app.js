document.addEventListener("DOMContentLoaded", () => {
  document.querySelectorAll(".confirm-delete").forEach(btn => {
    btn.addEventListener("click", e => {
      if (!confirm("Delete this post? This action cannot be undone.")) e.preventDefault();
    });
  });
});
