/******/ (() => { // webpackBootstrap
/*!************************************!*\
  !*** ./src/scripts/child-theme.js ***!
  \************************************/
/**
 * Starter JS file for child theme.
 * wp.domReady is a useful JS hook.
*/

document.addEventListener('DOMContentLoaded', function () {
  // Use these variables outside of the ajax call
  var userSelections = [];
  var currentSelect = {};

  // Get all the labels with the class 'unselected' inside '.card-checkmark'
  document.querySelectorAll('.card-checkmark label.unselected').forEach(function (label) {
    label.addEventListener('click', function () {
      // Select the checkbox sibling and check it
      var checkbox = label.parentElement.querySelector('input[type=checkbox]');
      checkbox.checked = true;

      // Find the parent card element and add the 'card-selected' class
      var card = label.closest('.card');
      if (card) {
        card.classList.add('card-selected');
      }

      // Get the current year and slug from the parent form's data attributes
      var form = label.closest('form');
      var curYear = form.getAttribute('data-year');
      var curSlug = form.getAttribute('data-slug');
      var programTitle = card.querySelector('h3.card-title').innerText;
      var programDescription = card.querySelector('.program-description').innerText;
      var readMoreLink = card.querySelector('a.read-more').getAttribute('href');

      // Create the currentSelect object
      var currentSelect = {
        year: curYear,
        slug: curSlug,
        title: programTitle,
        description: programDescription,
        link: readMoreLink
      };

      // Add to the user selection array
      userSelections.push(currentSelect);
      console.log(userSelections);
    });
  });

  // Get all the labels with the class 'selected' inside '.card-checkmark'
  document.querySelectorAll('.card-checkmark label.selected').forEach(function (label) {
    label.addEventListener('click', function () {
      // Select the checkbox sibling and uncheck it
      var checkbox = label.parentElement.querySelector('input[type=checkbox]');
      checkbox.checked = false;

      // Find the parent card element and remove the 'card-selected' class
      var card = label.closest('.card');
      if (card) {
        card.classList.remove('card-selected');
      }

      // Get the current year and slug from the parent form's data attributes
      var form = label.closest('form');
      var curYear = form.getAttribute('data-year');
      var curSlug = form.getAttribute('data-slug');

      // Remove the clicked item from the user selection array
      for (var i = userSelections.length - 1; i >= 0; --i) {
        if (userSelections[i].year == curYear && userSelections[i].slug == curSlug) {
          userSelections.splice(i, 1);
        }
      }
    });
  });
  document.querySelectorAll('.card-checkmark label').forEach(function (label) {
    label.addEventListener('click', function () {
      var screenList = document.querySelector('.result-list');
      var emailList = document.querySelector('ul.results');
      screenList.innerHTML = '';
      emailList.innerHTML = '';

      // Sort the user selections by year
      userSelections.sort((a, b) => a.year.localeCompare(b.year));

      // Look up selected card from results table earlier to make all fields available for formatting.
      userSelections.forEach(function (pick) {
        // Output: Screen list items.
        screenList.insertAdjacentHTML('beforeend', '<div class="choice ' + pick.year + '"><a href="' + pick.link + '">' + pick.title + '</a></div>');

        // Output: Email bullet points.
        var printYear = '';
        switch (pick.year) {
          case 'year-1':
            printYear = 'Year 1';
            break;
          case 'year-2':
            printYear = 'Year 2';
            break;
          case 'year-3':
            printYear = 'Year 3';
            break;
          case 'year-4':
            printYear = 'Year 4';
            break;
        }
        emailList.insertAdjacentHTML('beforeend', '<li style="padding-bottom: 20px"><strong>' + printYear + '</strong> - <a style="font-weight:700;" href="' + pick.link + '">' + pick.title + '</a> - ' + pick.description + '</li>');
      });
    });
  });
});
/******/ })()
;
//# sourceMappingURL=child-theme.js.map