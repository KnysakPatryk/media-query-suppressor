# Media Query Suppressor
This library allows you to "suppress" media queries in your dynamic html content.
Why would you do that? You have to do that if your site is responsive (for example based on Bootstrap) and you want to create non-responsive (classic) version of your site for mobile devices.

## Example use case
Client has website based on Bootstrap.
He wants to add classic version of the site - just by clicking on the button in the bottom of the page.
Classic version should not vary on devices and screen sizes (non-responsive).

How can we do that?
1. First, we create another, non-responsive css spreadsheet for classic version (this step can be also done by this library).
2. Next, we use this library to "suppress" any other media queries from dynamic html (for example loaded from database).
3. Lastly, we add button at the bottom of the page, to switch website version cookie.