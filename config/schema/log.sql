ALTER TABLE  `profiles` ADD  `created_by` INT( 11 ) UNSIGNED ZEROFILL NULL AFTER  `user_id` ;
ALTER TABLE  `profiles` ADD FOREIGN KEY (  `created_by` ) REFERENCES  `project`.`users` (
`id`
) ON DELETE RESTRICT ON UPDATE RESTRICT ;
