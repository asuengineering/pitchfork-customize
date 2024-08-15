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
      screenList.innerHTML = '';
      var emailListItems = '';

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

        // Append the formatted string to the textarea's current value
        emailListItems += '<li style="padding-bottom: 20px"><strong>' + printYear + '</strong> - <a style="font-weight:700;" href="' + pick.link + '">' + pick.title + '</a> - ' + pick.description + '</li>';
      });
      var emailBodyTextArea = document.querySelector('textarea#input_1_4');
      var emailBodyBefore = '<div id="email"><table border="0" cellpadding="0" cellspacing="0" role="presentation" style="vertical-align:top" width="100%"><tr><td align="left" style="font-size:0;padding:10px 25px;word-break:break-word"><div style="font-family:Arial,sans-serif;font-size:20px;font-weight:700;line-height:24px;text-align:left;color:#191919">Your customized ASU Engineering experience</div></td></tr><tr><td align="left" style="font-size:0;padding:10px 25px;word-break:break-word"><div class="form-name" style="font-family:Arial,sans-serif;font-size:16px;font-weight:400;line-height:24px;text-align:left;color:#747474"></div></td></tr><tr><td align="left" style="font-size:0;padding:10px 25px;word-break:break-word"><div style="font-family:Arial,sans-serif;font-size:16px;font-weight:400;line-height:24px;text-align:left;color:#747474">Experiential opportunities are integral components of your Fulton Schools experience and the skills you gain will help prepare you for whatever you choose to do after graduation. These opportunities are part of the Fulton Difference - our commitment to foster student success in our innovators and engineers from day one. Surrounding your coursework with these opportunities will provide you with the tools to be the most qualified and competitive for engineering internships, jobs and graduate programs across the globe.</div></td></tr><tr><td align="left" style="font-size:0;padding:10px 25px;word-break:break-word"><div style="font-family:Arial,sans-serif;font-size:16px;font-weight:400;line-height:24px;text-align:left;color:#747474">By utilizing the Fulton Schools’ Customize tool, you have taken a step towards engineering your own future. Below is your Customize Map, showing the programs you have selected to help propel you to the next level.</div></td></tr><tr><td align="left" style="font-size:0;padding:10px 25px;word-break:break-word"><div style="font-family:Arial,sans-serif;font-size:16px;font-weight:400;line-height:24px;text-align:left;color:#747474">';
      var emailBodyAfter = '<tr><td align="left" style="font-size:0;padding:10px 25px;padding-bottom:30px;word-break:break-word"><div style="font-family:Arial,sans-serif;font-size:16px;font-weight:400;line-height:24px;text-align:left;color:#747474">Combine your Customize map with your <a href="https://engineering.asu.edu/undergraduate-degree-programs/">degree major map</a>, to create your personalized college path. And we know that your goals can change throughout your time as a student, so keep returning the Customize tool or meet with your Academic Advisor when you feel the need to adjust your path.</div></td></tr><tr><td align="left" style="font-size:0;padding:10px 25px;word-break:break-word"><div style="font-family:Arial,sans-serif;font-size:16px;font-weight:400;line-height:24px;text-align:left;color:#747474">If you have questions about any of the programs you see in Customize, please feel free to reach out to us at <a href="mailto:FultonSchools@asu.edu">FultonSchools@asu.edu</a>. We are here to support you throughout your journey, and cannot wait to see what you will accomplish as a member of the Fulton Schools Family.</div></td></tr>';
      emailBodyTextArea.value = emailBodyBefore + '<ul>' + emailListItems + '</ul>' + emailBodyAfter;
    });
  });

  // Load two additional form fields with lots of HTML for email header/footer.
  // One time operation, can do it immediately after DOM load.

  var emailBodyTop = '<!doctype html><html xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office"><head><title>Your Customized Experience</title><!--[if !mso]><!-- --><meta http-equiv="X-UA-Compatible" content="IE=edge"><!--<![endif]--><meta http-equiv="Content-Type" content="text/html; charset=UTF-8"><meta name="viewport" content="width=device-width,initial-scale=1"><style type="text/css">#outlook a { padding:0; }body { margin:0;padding:0;-webkit-text-size-adjust:100%;-ms-text-size-adjust:100%; }table, td { border-collapse:collapse;mso-table-lspace:0pt;mso-table-rspace:0pt; }img { border:0;height:auto;line-height:100%; outline:none;text-decoration:none;-ms-interpolation-mode:bicubic; }p { display:block;margin:13px 0; }</style><!--[if mso]><xml><o:OfficeDocumentSettings><o:AllowPNG/><o:PixelsPerInch>96</o:PixelsPerInch></o:OfficeDocumentSettings></xml><![endif]--><!--[if lte mso 11]><style type="text/css">.mj-outlook-group-fix { width:100% !important; }</style><![endif]--><style type="text/css">@media only screen and (min-width:480px) {.mj-column-per-100 { width:100% !important; max-width: 100%; }}</style><style type="text/css">@media only screen and (max-width:480px) {table.mj-full-width-mobile { width: 100% !important; }td.mj-full-width-mobile { width: auto !important; }}</style></head><body style="background-color:#e8e8e8;"><div style="display:none;font-size:1px;color:#ffffff;line-height:1px;max-height:0px;max-width:0px;opacity:0;overflow:hidden;">Here are your selections from the Customize website.</div><div style="background-color:#e8e8e8;"><table align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="background:#8c1d40;background-color:#8c1d40;width:100%;"><tbody><tr><td><!--[if mso | IE]><table align="center" border="0" cellpadding="0" cellspacing="0" class="" style="width:600px;" width="600" ><tr><td style="line-height:0px;font-size:0px;mso-line-height-rule:exactly;"><![endif]--><div style="margin:0px auto;max-width:600px;"><table align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="width:100%;"><tbody><tr><td style="direction:ltr;font-size:0px;padding:20px 0;padding-bottom:0;text-align:center;"><!--[if mso | IE]><table role="presentation" border="0" cellpadding="0" cellspacing="0"><tr><td class="" style="vertical-align:top;width:600px;" ><![endif]--><div class="mj-column-per-100 mj-outlook-group-fix" style="font-size:0px;text-align:left;direction:ltr;display:inline-block;vertical-align:top;width:100%;"><table border="0" cellpadding="0" cellspacing="0" role="presentation" style="vertical-align:top;" width="100%"><tr><td align="center" style="font-size:0px;padding:10px 25px;word-break:break-word;"><table border="0" cellpadding="0" cellspacing="0" role="presentation" style="border-collapse:collapse;border-spacing:0px;"><tbody><tr><td style="width:350px;"><img alt="" height="auto" src="https://dev-customize-static.pantheonsite.io/assets/img/endorsed-logo/asu_fultonengineering_horiz_rgb_white_150ppi.png" style="border:0;display:block;outline:none;text-decoration:none;height:auto;width:100%;font-size:13px;" width="350"></td></tr></tbody></table></td></tr><tr><td align="center" style="font-size:0px;padding:0;word-break:break-word;"><table border="0" cellpadding="0" cellspacing="0" role="presentation" style="border-collapse:collapse;border-spacing:0px;"><tbody><tr><td style="width:600px;"><img alt="" height="auto" src="https://dev-customize-static.pantheonsite.io/assets/img/cards/email-studentorgs-top.jpg" style="border:0;display:block;outline:none;text-decoration:none;height:auto;width:100%;font-size:13px;" width="600"></td></tr></tbody></table></td></tr></table></div><!--[if mso | IE]></td></tr></table><![endif]--></td></tr></tbody></table></div><!--[if mso | IE]></td></tr></table><![endif]--></td></tr></tbody></table><!--[if mso | IE]><table align="center" border="0" cellpadding="0" cellspacing="0" class="" style="width:600px;" width="600" ><tr><td style="line-height:0px;font-size:0px;mso-line-height-rule:exactly;"><![endif]--><div style="background:#e8e8e8;background-color:#e8e8e8;margin:0px auto;max-width:600px;"><table align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="background:#e8e8e8;background-color:#e8e8e8;width:100%;"><tbody><tr><td style="direction:ltr;font-size:0px;padding:20px 0;padding-bottom:0;padding-top:0;text-align:center;"><!--[if mso | IE]><table role="presentation" border="0" cellpadding="0" cellspacing="0"><tr><td class="" style="vertical-align:top;width:600px;" ><![endif]--><div class="mj-column-per-100 mj-outlook-group-fix" style="font-size:0px;text-align:left;direction:ltr;display:inline-block;vertical-align:top;width:100%;"><table border="0" cellpadding="0" cellspacing="0" role="presentation" style="vertical-align:top;" width="100%"><tr><td align="center" style="font-size:0px;padding:0;word-break:break-word;"><table border="0" cellpadding="0" cellspacing="0" role="presentation" style="border-collapse:collapse;border-spacing:0px;"><tbody><tr><td style="width:600px;"><img alt="" height="auto" src="https://dev-customize-static.pantheonsite.io/assets/img/cards/email-studentorgs-bottom.jpg" style="border:0;display:block;outline:none;text-decoration:none;height:auto;width:100%;font-size:13px;" width="600"></td></tr></tbody></table></td></tr></table></div><!--[if mso | IE]></td></tr></table><![endif]--></td></tr></tbody></table></div><!--[if mso | IE]></td></tr></table><table align="center" border="0" cellpadding="0" cellspacing="0" class="body-section-outlook" style="width:600px;" width="600" ><tr><td style="line-height:0px;font-size:0px;mso-line-height-rule:exactly;"><![endif]--><div class="body-section" style="-webkit-box-shadow: 1px 4px 11px 0px rgba(0, 0, 0, 0.15); -moz-box-shadow: 1px 4px 11px 0px rgba(0, 0, 0, 0.15); box-shadow: 1px 4px 11px 0px rgba(0, 0, 0, 0.15); margin: 0px auto; max-width: 600px;"><table align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="width:100%;"><tbody><tr><td style="direction:ltr;font-size:0px;padding:20px 0;padding-bottom:0;padding-top:0;text-align:center;"><!--[if mso | IE]><table role="presentation" border="0" cellpadding="0" cellspacing="0"><tr><td class="" width="600px" ><table align="center" border="0" cellpadding="0" cellspacing="0" class="" style="width:600px;" width="600" ><tr><td style="line-height:0px;font-size:0px;mso-line-height-rule:exactly;"><![endif]--><div style="background:#ffffff;background-color:#ffffff;margin:0px auto;max-width:600px;"><table align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="background:#ffffff;background-color:#ffffff;width:100%;"><tbody><tr><td style="direction:ltr;font-size:0px;padding:20px 0;padding-left:15px;padding-right:15px;text-align:center;"><!--[if mso | IE]><table role="presentation" border="0" cellpadding="0" cellspacing="0"><tr><td class="" style="vertical-align:top;width:570px;" ><![endif]--><div class="mj-column-per-100 mj-outlook-group-fix" style="font-size:0px;text-align:left;direction:ltr;display:inline-block;vertical-align:top;width:100%;">';
  var emailBodyBottom = '</div><!--[if mso | IE]></td></tr></table><![endif]--></td></tr></tbody></table></div><!--[if mso | IE]></td></tr></table></td></tr></table><![endif]--></td></tr></tbody></table></div><!--[if mso | IE]></td></tr></table><![endif]--><table align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="width:100%;"><tbody><tr><td><!--[if mso | IE]><table align="center" border="0" cellpadding="0" cellspacing="0" class="" style="width:600px;" width="600" ><tr><td style="line-height:0px;font-size:0px;mso-line-height-rule:exactly;"><![endif]--><div style="margin:0px auto;max-width:600px;"><table align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="width:100%;"><tbody><tr><td style="direction:ltr;font-size:0px;padding:20px 0;text-align:center;"><!--[if mso | IE]><table role="presentation" border="0" cellpadding="0" cellspacing="0"><tr><td class="" width="600px" ><table align="center" border="0" cellpadding="0" cellspacing="0" class="" style="width:600px;" width="600" ><tr><td style="line-height:0px;font-size:0px;mso-line-height-rule:exactly;"><![endif]--><div style="margin:0px auto;max-width:600px;"><table align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="width:100%;"><tbody><tr><td style="direction:ltr;font-size:0px;padding:20px 0;text-align:center;"><!--[if mso | IE]><table role="presentation" border="0" cellpadding="0" cellspacing="0"><tr><td class="" style="vertical-align:top;width:600px;" ><![endif]--><div class="mj-column-per-100 mj-outlook-group-fix" style="font-size:0px;text-align:left;direction:ltr;display:inline-block;vertical-align:top;width:100%;"><table border="0" cellpadding="0" cellspacing="0" role="presentation" width="100%"><tbody><tr><td style="vertical-align:top;padding:0;"><table border="0" cellpadding="0" cellspacing="0" role="presentation" width="100%"><tr><td align="center" style="font-size:0px;padding:0;word-break:break-word;"><!--[if mso | IE]><table align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" ><tr><td><![endif]--><table align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="float:none;display:inline-table;"><tr><td style="padding:4px;"><table border="0" cellpadding="0" cellspacing="0" role="presentation" style="background:#A1A0A0;border-radius:3px;width:30px;"><tr><td style="font-size:0;height:30px;vertical-align:middle;width:30px;"><a href="https://www.facebook.com/ASUEngineering" target="_blank"><img height="30" src="https://www.mailjet.com/images/theme/v1/icons/ico-social/facebook.png" style="border-radius:3px;display:block;" width="30"></a></td></tr></table></td></tr></table><!--[if mso | IE]></td><td><![endif]--><table align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="float:none;display:inline-table;"><tr><td style="padding:4px;"><table border="0" cellpadding="0" cellspacing="0" role="presentation" style="background:#A1A0A0;border-radius:3px;width:30px;"><tr><td style="font-size:0;height:30px;vertical-align:middle;width:30px;"><a href="https://twitter.com/ASUEngineering" target="_blank"><img height="30" src="https://www.mailjet.com/images/theme/v1/icons/ico-social/twitter.png" style="border-radius:3px;display:block;" width="30"></a></td></tr></table></td></tr></table><!--[if mso | IE]></td><td><![endif]--><table align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="float:none;display:inline-table;"><tr><td style="padding:4px;"><table border="0" cellpadding="0" cellspacing="0" role="presentation" style="background:#A1A0A0;border-radius:3px;width:30px;"><tr><td style="font-size:0;height:30px;vertical-align:middle;width:30px;"><a href="https://www.linkedin.com/edu/ira-a.-fulton-schools-of-engineering-at-arizona-state-university-43093" target="_blank"><img height="30" src="https://www.mailjet.com/images/theme/v1/icons/ico-social/linkedin.png" style="border-radius:3px;display:block;" width="30"></a></td></tr></table></td></tr></table><!--[if mso | IE]></td><td><![endif]--><table align="center" border="0" cellpadding="0" cellspacing="0" role="presentation" style="float:none;display:inline-table;"><tr><td style="padding:4px;"><table border="0" cellpadding="0" cellspacing="0" role="presentation" style="background:#A1A0A0;border-radius:3px;width:30px;"><tr><td style="font-size:0;height:30px;vertical-align:middle;width:30px;"><a href="http://instagram.com/asuengineering" target="_blank"><img height="30" src="https://www.mailjet.com/images/theme/v1/icons/ico-social/instagram.png" style="border-radius:3px;display:block;" width="30"></a></td></tr></table></td></tr></table><!--[if mso | IE]></td></tr></table><![endif]--></td></tr><tr><td align="center" style="font-size:0px;padding:10px 25px;word-break:break-word;"><div style="font-family:Arial, sans-serif;font-size:11px;font-weight:400;line-height:16px;text-align:center;color:#445566;">You are receiving this email because you are awesome and have customized an experience of extra-curricular activities for ASU Engineering.</div></td></tr><tr><td align="center" style="font-size:0px;padding:10px 25px;word-break:break-word;"><div style="font-family:Arial, sans-serif;font-size:11px;font-weight:400;line-height:16px;text-align:center;color:#445566;">ASU Ira A. Fulton Schools of Engineering<br>699 S Mill Ave, Tempe, AZ, 85281, USA<br>Copyright © 2020 Arizona Board of Regents</div></td></tr></table></td></tr></tbody></table></div><!--[if mso | IE]></td></tr></table><![endif]--></td></tr></tbody></table></div><!--[if mso | IE]></td></tr></table></td></tr></table><![endif]--></td></tr></tbody></table></div><!--[if mso | IE]></td></tr></table><![endif]--></td></tr></tbody></table></div></body></html>';
  var headerTextArea = document.querySelector('textarea#input_1_6');
  headerTextArea.value = emailBodyTop;
  var footerTextArea = document.querySelector('textarea#input_1_7');
  footerTextArea.value = emailBodyBottom;
});
/******/ })()
;
//# sourceMappingURL=child-theme.js.map