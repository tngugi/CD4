CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_region_details` AS select `reg`.`id` AS `region_id`,`reg`.`name` AS `region_name`,`reg`.`fusion_id` AS `region_fusion_id`,`par_reg`.`partner_id` AS `partner_id`,`par`.`name` AS `partner_name`,`par`.`email` AS `partner_email`,`par`.`phone` AS `partner_phone` from (`district` `dis` left join ((`region` `reg` left join `partner_regions` `par_reg` on((`reg`.`id` = `par_reg`.`region_id`))) left join `partner` `par` on((`par_reg`.`partner_id` = `par`.`id`))) on((`dis`.`region_id` = `reg`.`id`))) group by `region_id` order by `region_name`