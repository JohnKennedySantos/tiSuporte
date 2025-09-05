document.addEventListener("DOMContentLoaded", function () {
  const menuButton = document.getElementById("mobile-menu");
  const sidebar = document.getElementById("sidebar");
  const sidebarLinks = document.querySelectorAll(".sidebar ul li a");

  // Toggle da sidebar (expandir/colapsar)
  if (menuButton && sidebar) {
    menuButton.addEventListener("click", function () {
      sidebar.classList.toggle("active");
    });
  }

  // Controle de item ativo ao clicar
  sidebarLinks.forEach(link => {
    link.addEventListener("click", function () {
      sidebarLinks.forEach(l => l.parentElement.classList.remove("active"));
      link.parentElement.classList.add("active");
    });
  });

  // Marcar automaticamente item ativo baseado na URL
  const urlParams = new URLSearchParams(window.location.search);
  const rotaAtual = urlParams.get("rota"); // pega o valor do parâmetro 'rota'

  sidebarLinks.forEach(link => {
    const li = link.parentElement;
    const href = link.getAttribute("href");
    // verifica se o href contém a rota atual
    if (rotaAtual && href.includes(`rota=${rotaAtual}`)) {
      li.classList.add("active");
    } else {
      li.classList.remove("active");
    }
  });
});
