Main plugins used:
Jetpack
The Events Calendar
WP like button

﻿Theme inherits from rebalance theme. Changes are commented by "mmmnmnm" and "mmn".

1. Changes that need to be re-added after theme (rebalance) update
- /wp-content/themes/rebalance/js/navigation.js (line 14): column number changed from 3 to 4 -> effect: "English content" menu shows under main manu

2. Changes that need to be re-added after calendar (the events calendar) update:
- /wp-content/plugins/the-events-calendar/src/Tribe/Main.php (line 67): has_archive attribute to false -> effect: events in calendar's month view are aligned horizontally

3. (OPTIONAL) Changes that need to be re-added after Wordpress update:
-	/wp-includes/functions.php (line 106) and corresponding definition of myucfirst() function -> effect: first letter of months uppercased