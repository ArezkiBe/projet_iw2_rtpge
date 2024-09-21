document.addEventListener('DOMContentLoaded', () => {
  const workspace = document.getElementById('page-content');
  const components = document.querySelectorAll('.component');  

  // Configuration de SortableJS sur la zone de travail
  Sortable.create(workspace, {});

  console.log("test");


  components.forEach(component => {
      component.addEventListener('dragstart', (e) => {
          e.dataTransfer.setData('text/plain', component.dataset.type);
      });
  });

  function addComponentToWorkspace(type, item) {
      // Utilisation d'AJAX pour charger le composant PHP
      const xhr = new XMLHttpRequest();
      xhr.open('GET', `/components/${type}.php`, true);
      xhr.onload = function () {
          if (xhr.status === 200) {
              const div = document.createElement('div');
              div.innerHTML = xhr.responseText;
              item.replaceWith(div); // Remplace le placeholder par le contenu réel
          }
      };
      xhr.send();
  }
});
