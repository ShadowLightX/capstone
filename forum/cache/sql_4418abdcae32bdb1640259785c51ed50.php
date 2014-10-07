<?php exit; ?>
1412697173
SELECT m.*, u.user_colour, g.group_colour, g.group_type FROM (net_neutrality_moderator_cache m) LEFT JOIN net_neutrality_users u ON (m.user_id = u.user_id) LEFT JOIN net_neutrality_groups g ON (m.group_id = g.group_id) WHERE m.display_on_index = 1
6
a:0:{}