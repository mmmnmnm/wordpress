Theme inherits from rebalance theme. All changes in anywhere are commented by "mmmnmnm" and "mmn".

1. Changes that should not be affected by updates
 - Can be found under /wp-content/themes/rebalance-child-mmn

2. Changes that need to be re-added after theme (rebalance) update
- /wp-content/themes/rebalance/js/navigation.js (line 14): column number changed from 3 to 4 -> effect: "English content" menu shows under main manu

3. Changes that need to be re-added after calendar (the events calendar) update:
- /wp-content/plugins/the-events-calendar/src/Tribe/Main.php (line 67): has_archive attribute to false -> effect: events in calendar's month view are aligned horizontally

4. Changes that need to be re-added after Wordpress update:
-	/wp-includes/functions.php (line 106) and corresponding definition of myucfirst() function -> effect: first letter of months uppercased

Other notes:
- Site description is currently disabled and is replaced by constant donate info (site descr. is still visible on the browser tab)
- "Bug: text invisible on some machines, see readme for bug fix url": http://www.wastedpotential.com/solved-google-web-fonts-not-displaying-on-some-macs/

TODOs:
- Display multiple category page title when multiple categories are displayed, e.g., mmmnmnm.com/category/review,interview
  - Hint: /themes/archive.php -> page title
