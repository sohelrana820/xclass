-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 22, 2017 at 07:31 PM
-- Server version: 5.7.20-0ubuntu0.16.04.1
-- PHP Version: 7.0.22-0ubuntu0.16.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `task_manager`
--

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `uuid`, `user_id`, `task_id`, `comment`, `status`, `created`, `modified`, `changing_status`) VALUES
(1, 'f9a85348-bbf3-422c-8a88-4af1ef1c6abb', 23, 3, 'Fixed', 1, '2017-11-22 19:24:12', '2017-11-22 19:24:12', 'closed');

--
-- Dumping data for table `feeds`
--

INSERT INTO `feeds` (`id`, `project_id`, `task_id`, `title`, `event`, `created`) VALUES
(1, 1, NULL, '<a class=\'author_link\' href=\'http://localhost/task-manager/users/view/80d0eeb0-9612-47dd-a718-c7c1cb0da07d\'>Sohel Rana</a> has been created new project <a class=\'project_link\' href=\'http://localhost/task-manager/projects/implement-oauth-2-server\'>Implement oAuth 2 Server</a>', 'create_project', '2017-11-22 19:21:04'),
(2, 1, NULL, '<a class=\'author_link\' href=\'http://localhost/task-manager/users/view/b4a71476-daab-4597-ae80-40bcfd615046\'>Leah Sanchez</a> has been added to <a class=\'project_link\' href=\'http://localhost/task-manager/projects/implement-oauth-2-server\'>Implement oAuth 2 Server</a>', 'add_contributor', '2017-11-22 19:22:08'),
(3, 1, NULL, '<a class=\'author_link\' href=\'http://localhost/task-manager/users/view/f0dae69d-c3bb-4c99-9065-3c954c5d90e6\'>Cassidy James</a> has been added to <a class=\'project_link\' href=\'http://localhost/task-manager/projects/implement-oauth-2-server\'>Implement oAuth 2 Server</a>', 'add_contributor', '2017-11-22 19:22:11'),
(4, 1, NULL, '<a class=\'author_link\' href=\'http://localhost/task-manager/users/view/80d0eeb0-9612-47dd-a718-c7c1cb0da07d\'>Sohel Rana</a> has been created new label <label style=\'border: 1px solid #0E5563; color: #0E5563\'>Enhancement</label>', 'create_label', '2017-11-22 19:22:41'),
(5, 1, NULL, '<a class=\'author_link\' href=\'http://localhost/task-manager/users/view/80d0eeb0-9612-47dd-a718-c7c1cb0da07d\'>Sohel Rana</a> has been created new label <label style=\'border: 1px solid #C00C00; color: #C00C00\'>Error</label>', 'create_label', '2017-11-22 19:22:45'),
(6, 1, NULL, '<a class=\'author_link\' href=\'http://localhost/task-manager/users/view/80d0eeb0-9612-47dd-a718-c7c1cb0da07d\'>Sohel Rana</a> has been created new label <label style=\'border: 1px solid #0092C0; color: #0092C0\'>RND</label>', 'create_label', '2017-11-22 19:22:52'),
(7, 1, 1, '<a class=\'author_link\' href=\'http://localhost/task-manager/users/view/80d0eeb0-9612-47dd-a718-c7c1cb0da07d\'>Sohel Rana</a> has been opened new task <a class=\'project_link\' href=\'http://localhost/task-manager/implement-oauth-2-server/tasks/1\'>Analysis requirement based on RFC</a>', 'opened_task', '2017-11-22 19:23:18'),
(8, 1, 1, '<label style=\'border: 1px solid #0092C0; color: #0092C0\'>RND</label> label has been added to <a class=\'project_link\' href=\'http://localhost/task-manager/implement-oauth-2-server/tasks/1\'>Analysis requirement based on RFC</a>', 'added_label', '2017-11-22 19:23:18'),
(9, 1, 1, '<a class=\'author_link\' href=\'http://localhost/task-manager/users/view/b4a71476-daab-4597-ae80-40bcfd615046\'>Leah Sanchez</a> assigned to <a class=\'project_link\' href=\'http://localhost/task-manager/implement-oauth-2-server/tasks/1\'>Analysis requirement based on RFC</a>', 'assigned_user', '2017-11-22 19:23:18'),
(10, 1, 2, '<a class=\'author_link\' href=\'http://localhost/task-manager/users/view/80d0eeb0-9612-47dd-a718-c7c1cb0da07d\'>Sohel Rana</a> has been opened new task <a class=\'project_link\' href=\'http://localhost/task-manager/implement-oauth-2-server/tasks/2\'>Deploy a new server</a>', 'opened_task', '2017-11-22 19:23:42'),
(11, 1, 2, '<label style=\'border: 1px solid #0E5563; color: #0E5563\'>Enhancement</label> label has been added to <a class=\'project_link\' href=\'http://localhost/task-manager/implement-oauth-2-server/tasks/2\'>Deploy a new server</a>', 'added_label', '2017-11-22 19:23:42'),
(12, 1, 2, '<a class=\'author_link\' href=\'http://localhost/task-manager/users/view/b4a71476-daab-4597-ae80-40bcfd615046\'>Leah Sanchez</a> assigned to <a class=\'project_link\' href=\'http://localhost/task-manager/implement-oauth-2-server/tasks/2\'>Deploy a new server</a>', 'assigned_user', '2017-11-22 19:23:42'),
(13, 1, 3, '<a class=\'author_link\' href=\'http://localhost/task-manager/users/view/80d0eeb0-9612-47dd-a718-c7c1cb0da07d\'>Sohel Rana</a> has been opened new task <a class=\'project_link\' href=\'http://localhost/task-manager/implement-oauth-2-server/tasks/3\'>Fixed the design issue</a>', 'opened_task', '2017-11-22 19:24:01'),
(14, 1, 3, '<label style=\'border: 1px solid #C00C00; color: #C00C00\'>Error</label> label has been added to <a class=\'project_link\' href=\'http://localhost/task-manager/implement-oauth-2-server/tasks/3\'>Fixed the design issue</a>', 'added_label', '2017-11-22 19:24:01'),
(15, 1, 3, '<a class=\'author_link\' href=\'http://localhost/task-manager/users/view/f0dae69d-c3bb-4c99-9065-3c954c5d90e6\'>Cassidy James</a><a class=\'author_link\' href=\'http://localhost/task-manager/users/view/b4a71476-daab-4597-ae80-40bcfd615046\'>Leah Sanchez</a> assigned to <a class=\'project_link\' href=\'http://localhost/task-manager/implement-oauth-2-server/tasks/3\'>Fixed the design issue</a>', 'assigned_user', '2017-11-22 19:24:02'),
(16, 1, 3, '<a class=\'author_link\' href=\'http://localhost/task-manager/users/view/80d0eeb0-9612-47dd-a718-c7c1cb0da07d\'>Sohel Rana</a> <strong class=\'label label-default\'>closed</strong> task <a class=\'project_link\' href=\'http://localhost/task-manager/implement-oauth-2-server/tasks/3\'>Task #3</a>', 'task_closed', '2017-11-22 19:24:12'),
(17, 1, NULL, '<a class=\'author_link\' href=\'http://localhost/task-manager/users/view/80d0eeb0-9612-47dd-a718-c7c1cb0da07d\'>Sohel Rana</a> commented "<a class=\'project_link\' href=\'http://localhost/task-manager/implement-oauth-2-server/tasks/3#/f9a85348-bbf3-422c-8a88-4af1ef1c6abb\'>Fixed</a>"" on <a class=\'project_link\' href=\'http://localhost/task-manager/implement-oauth-2-server/tasks/3\'>Task #3</a>', 'commented', '2017-11-22 19:24:12'),
(18, 2, NULL, '<a class=\'author_link\' href=\'http://localhost/task-manager/users/view/80d0eeb0-9612-47dd-a718-c7c1cb0da07d\'>Sohel Rana</a> has been created new project <a class=\'project_link\' href=\'http://localhost/task-manager/projects/psd-to-html-conversion\'>PSD to HTML Conversion</a>', 'create_project', '2017-11-22 19:24:55'),
(19, 2, NULL, '<a class=\'author_link\' href=\'http://localhost/task-manager/users/view/80d0eeb0-9612-47dd-a718-c7c1cb0da07d\'>Sohel Rana</a> has been created new label <label style=\'border: 1px solid #C00C00; color: #C00C00\'>Design Issue</label>', 'create_label', '2017-11-22 19:25:12'),
(20, 2, NULL, '<a class=\'author_link\' href=\'http://localhost/task-manager/users/view/80d0eeb0-9612-47dd-a718-c7c1cb0da07d\'>Sohel Rana</a> has been created new label <label style=\'border: 1px solid #810800; color: #810800\'>Emmergency</label>', 'create_label', '2017-11-22 19:25:25'),
(21, 2, NULL, '<a class=\'author_link\' href=\'http://localhost/task-manager/users/view/2a8debb6-051b-410e-b75b-7000664d299c\'>General User</a> has been added to <a class=\'project_link\' href=\'http://localhost/task-manager/projects/psd-to-html-conversion\'>PSD to HTML Conversion</a>', 'add_contributor', '2017-11-22 19:25:45'),
(22, 3, NULL, '<a class=\'author_link\' href=\'http://localhost/task-manager/users/view/80d0eeb0-9612-47dd-a718-c7c1cb0da07d\'>Sohel Rana</a> has been created new project <a class=\'project_link\' href=\'http://localhost/task-manager/projects/build-custom-crm\'>Build Custom CRM</a>', 'create_project', '2017-11-22 19:26:37'),
(23, 3, NULL, '<a class=\'author_link\' href=\'http://localhost/task-manager/users/view/80d0eeb0-9612-47dd-a718-c7c1cb0da07d\'>Sohel Rana</a> has been created new label <label style=\'border: 1px solid #904D48; color: #904D48\'>Design</label>', 'create_label', '2017-11-22 19:26:51'),
(24, 3, NULL, '<a class=\'author_link\' href=\'http://localhost/task-manager/users/view/80d0eeb0-9612-47dd-a718-c7c1cb0da07d\'>Sohel Rana</a> has been created new label <label style=\'border: 1px solid #C00C00; color: #C00C00\'>APIs</label>', 'create_label', '2017-11-22 19:26:59'),
(25, 3, NULL, '<a class=\'author_link\' href=\'http://localhost/task-manager/users/view/80d0eeb0-9612-47dd-a718-c7c1cb0da07d\'>Sohel Rana</a> has been updated label <label style=\'border: 1px solid #2D6110; color: #2D6110\'>APIs</label>', 'update_label', '2017-11-22 19:27:06'),
(26, 3, NULL, '<a class=\'author_link\' href=\'http://localhost/task-manager/users/view/80d0eeb0-9612-47dd-a718-c7c1cb0da07d\'>Sohel Rana</a> has been created new label <label style=\'border: 1px solid #614F4E; color: #614F4E\'>Error</label>', 'create_label', '2017-11-22 19:27:11'),
(27, 3, NULL, '<a class=\'author_link\' href=\'http://localhost/task-manager/users/view/80d0eeb0-9612-47dd-a718-c7c1cb0da07d\'>Sohel Rana</a> has been created new label <label style=\'border: 1px solid #C00C00; color: #C00C00\'>Bugs</label>', 'create_label', '2017-11-22 19:27:15'),
(28, 3, NULL, '<a class=\'author_link\' href=\'http://localhost/task-manager/users/view/80d0eeb0-9612-47dd-a718-c7c1cb0da07d\'>Sohel Rana</a> has been created new label <label style=\'border: 1px solid #C00C00; color: #C00C00\'>Invalid</label>', 'create_label', '2017-11-22 19:27:25'),
(29, 3, NULL, '<a class=\'author_link\' href=\'http://localhost/task-manager/users/view/80d0eeb0-9612-47dd-a718-c7c1cb0da07d\'>Sohel Rana</a> has been created new label <label style=\'border: 1px solid #C00C00; color: #C00C00\'>Duplicate Issue</label>', 'create_label', '2017-11-22 19:27:33'),
(30, 3, NULL, '<a class=\'author_link\' href=\'http://localhost/task-manager/users/view/80d0eeb0-9612-47dd-a718-c7c1cb0da07d\'>Sohel Rana</a> has been updated label <label style=\'border: 1px solid #00C0A9; color: #00C0A9\'>Duplicate Issue</label>', 'update_label', '2017-11-22 19:27:41'),
(31, 3, NULL, '<a class=\'author_link\' href=\'http://localhost/task-manager/users/view/80d0eeb0-9612-47dd-a718-c7c1cb0da07d\'>Sohel Rana</a> has been updated label <label style=\'border: 1px solid #312A29; color: #312A29\'>Invalid</label>', 'update_label', '2017-11-22 19:27:46'),
(32, 3, NULL, '<a class=\'author_link\' href=\'http://localhost/task-manager/users/view/0ffa4a5f-9340-4fc0-8f02-dc415dd7eb52\'>Emma Strong</a> has been added to <a class=\'project_link\' href=\'http://localhost/task-manager/projects/build-custom-crm\'>Build Custom CRM</a>', 'add_contributor', '2017-11-22 19:27:57'),
(33, 3, NULL, '<a class=\'author_link\' href=\'http://localhost/task-manager/users/view/ba76f51a-d202-4ab0-990b-7133a18cca63\'>Mercedes Boyle</a> has been added to <a class=\'project_link\' href=\'http://localhost/task-manager/projects/build-custom-crm\'>Build Custom CRM</a>', 'add_contributor', '2017-11-22 19:28:00'),
(34, 3, 4, '<a class=\'author_link\' href=\'http://localhost/task-manager/users/view/80d0eeb0-9612-47dd-a718-c7c1cb0da07d\'>Sohel Rana</a> has been opened new task <a class=\'project_link\' href=\'http://localhost/task-manager/build-custom-crm/tasks/1\'>Fixed the website header</a>', 'opened_task', '2017-11-22 19:28:31'),
(35, 3, 4, '<label style=\'border: 1px solid #904D48; color: #904D48\'>Design</label><label style=\'border: 1px solid #C00C00; color: #C00C00\'>Bugs</label> label has been added to <a class=\'project_link\' href=\'http://localhost/task-manager/build-custom-crm/tasks/1\'>Fixed the website header</a>', 'added_label', '2017-11-22 19:28:31'),
(36, 3, 4, '<a class=\'author_link\' href=\'http://localhost/task-manager/users/view/ba76f51a-d202-4ab0-990b-7133a18cca63\'>Mercedes Boyle</a><a class=\'author_link\' href=\'http://localhost/task-manager/users/view/0ffa4a5f-9340-4fc0-8f02-dc415dd7eb52\'>Emma Strong</a> assigned to <a class=\'project_link\' href=\'http://localhost/task-manager/build-custom-crm/tasks/1\'>Fixed the website header</a>', 'assigned_user', '2017-11-22 19:28:31'),
(37, 3, 5, '<a class=\'author_link\' href=\'http://localhost/task-manager/users/view/80d0eeb0-9612-47dd-a718-c7c1cb0da07d\'>Sohel Rana</a> has been opened new task <a class=\'project_link\' href=\'http://localhost/task-manager/build-custom-crm/tasks/2\'>Fixed the Responsive Issue</a>', 'opened_task', '2017-11-22 19:28:49'),
(38, 3, 5, '<label style=\'border: 1px solid #904D48; color: #904D48\'>Design</label> label has been added to <a class=\'project_link\' href=\'http://localhost/task-manager/build-custom-crm/tasks/2\'>Fixed the Responsive Issue</a>', 'added_label', '2017-11-22 19:28:49'),
(39, 3, 5, '<a class=\'author_link\' href=\'http://localhost/task-manager/users/view/0ffa4a5f-9340-4fc0-8f02-dc415dd7eb52\'>Emma Strong</a> assigned to <a class=\'project_link\' href=\'http://localhost/task-manager/build-custom-crm/tasks/2\'>Fixed the Responsive Issue</a>', 'assigned_user', '2017-11-22 19:28:49'),
(40, 3, 6, '<a class=\'author_link\' href=\'http://localhost/task-manager/users/view/80d0eeb0-9612-47dd-a718-c7c1cb0da07d\'>Sohel Rana</a> has been opened new task <a class=\'project_link\' href=\'http://localhost/task-manager/build-custom-crm/tasks/3\'>Implement cPanel Apis</a>', 'opened_task', '2017-11-22 19:29:09'),
(41, 3, 6, '<label style=\'border: 1px solid #2D6110; color: #2D6110\'>APIs</label> label has been added to <a class=\'project_link\' href=\'http://localhost/task-manager/build-custom-crm/tasks/3\'>Implement cPanel Apis</a>', 'added_label', '2017-11-22 19:29:09'),
(42, 3, 6, '<a class=\'author_link\' href=\'http://localhost/task-manager/users/view/0ffa4a5f-9340-4fc0-8f02-dc415dd7eb52\'>Emma Strong</a> assigned to <a class=\'project_link\' href=\'http://localhost/task-manager/build-custom-crm/tasks/3\'>Implement cPanel Apis</a>', 'assigned_user', '2017-11-22 19:29:09'),
(43, 3, NULL, '<a class=\'author_link\' href=\'http://localhost/task-manager/users/view/80d0eeb0-9612-47dd-a718-c7c1cb0da07d\'>Sohel Rana</a> has been created new label <label style=\'border: 1px solid #00C045; color: #00C045\'>Enhancement</label>', 'create_label', '2017-11-22 19:30:16'),
(44, 3, 7, '<a class=\'author_link\' href=\'http://localhost/task-manager/users/view/80d0eeb0-9612-47dd-a718-c7c1cb0da07d\'>Sohel Rana</a> has been opened new task <a class=\'project_link\' href=\'http://localhost/task-manager/build-custom-crm/tasks/4\'>Complete the CRUD of customers</a>', 'opened_task', '2017-11-22 19:30:19'),
(45, 3, 7, '<label style=\'border: 1px solid #00C045; color: #00C045\'>Enhancement</label> label has been added to <a class=\'project_link\' href=\'http://localhost/task-manager/build-custom-crm/tasks/4\'>Complete the CRUD of customers</a>', 'added_label', '2017-11-22 19:30:19'),
(46, 3, 7, '<a class=\'author_link\' href=\'http://localhost/task-manager/users/view/ba76f51a-d202-4ab0-990b-7133a18cca63\'>Mercedes Boyle</a> assigned to <a class=\'project_link\' href=\'http://localhost/task-manager/build-custom-crm/tasks/4\'>Complete the CRUD of customers</a>', 'assigned_user', '2017-11-22 19:30:19');

--
-- Dumping data for table `labels`
--

INSERT INTO `labels` (`id`, `project_id`, `name`, `color_code`, `created_by`, `status`, `created`, `modified`) VALUES
(1, 1, 'Enhancement', '#0E5563', 23, 1, '2017-11-22 19:22:41', '2017-11-22 19:22:41'),
(2, 1, 'Error', '#C00C00', 23, 1, '2017-11-22 19:22:45', '2017-11-22 19:22:45'),
(3, 1, 'RND', '#0092C0', 23, 1, '2017-11-22 19:22:52', '2017-11-22 19:22:52'),
(4, 2, 'Design Issue', '#C00C00', 23, 1, '2017-11-22 19:25:12', '2017-11-22 19:25:12'),
(5, 2, 'Emmergency', '#810800', 23, 1, '2017-11-22 19:25:25', '2017-11-22 19:25:25'),
(6, 3, 'Design', '#904D48', 23, 1, '2017-11-22 19:26:51', '2017-11-22 19:26:51'),
(7, 3, 'APIs', '#2D6110', 23, 1, '2017-11-22 19:26:59', '2017-11-22 19:27:06'),
(8, 3, 'Error', '#614F4E', 23, 1, '2017-11-22 19:27:11', '2017-11-22 19:27:11'),
(9, 3, 'Bugs', '#C00C00', 23, 1, '2017-11-22 19:27:15', '2017-11-22 19:27:15'),
(10, 3, 'Invalid', '#312A29', 23, 1, '2017-11-22 19:27:25', '2017-11-22 19:27:46'),
(11, 3, 'Duplicate Issue', '#00C0A9', 23, 1, '2017-11-22 19:27:33', '2017-11-22 19:27:40'),
(12, 3, 'Enhancement', '#00C045', 23, 1, '2017-11-22 19:30:16', '2017-11-22 19:30:16');

--
-- Dumping data for table `profiles`
--

INSERT INTO `profiles` (`id`, `user_id`, `created_by`, `first_name`, `last_name`, `profile_pic`, `gender`, `birthday`, `street_1`, `street_2`, `phone`, `city`, `state`, `postal_code`, `country`, `created`, `modified`) VALUES
(23, 23, NULL, 'Sohel', 'Rana', '80d0eeb0-9612-47dd-a718-c7c1cb0da07d/favicon.ico', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2017-03-22 20:19:26', '2017-11-22 19:30:38'),
(24, 24, 23, 'Cassidy', 'James', 'f0dae69d-c3bb-4c99-9065-3c954c5d90e6/blue-birds.jpg.824x0_q71.jpg', 2, '2165-02-01', 'Est qui sequi reiciendis qui', 'Qui aliquid quos vero et irure aut officiis nemo dolores', '+284-39-8621445', 'Velit sit possimus accusantium', 'Jersey', 'Culpa e', 'Jersey', '2017-03-22 20:21:43', '2017-03-22 20:31:22'),
(25, 25, 23, 'Emma', 'Dyer', 'd8b17ee7-737e-4e20-879b-8cc0ba0ab93b/smile-coffee-cup-hd-3Ddeskt.jpg', 1, '2165-02-01', 'Dolorem veniam quisquam consequuntur qui', '', '+556-66-2976607', 'Autem consequatur quo nemo aspe', 'Saint Mary', 'Labore n', 'Antigua and Barbuda', '2017-03-22 20:22:07', '2017-04-22 12:25:10'),
(26, 26, 23, 'Faisal', 'Islam', '203d8686-47ee-478d-b155-9b5575e3c997/birds-picture-011.jpg', 1, '2192-01-03', '155/A Green Road, Dhanmondi, Dhaka-1205', 'Bangladesh', '12222', 'Dhaka', 'Barguna', '1205', 'Bangladesh', '2017-03-22 20:23:13', '2017-03-22 20:31:45'),
(27, 27, 23, 'Allegra', 'Perry', 'a6fb4459-a8cb-4b74-afe2-b9c335edc22a/sfw_apa_2013_28342_232388_briankushner_blue_jay_kk_high.jpg', 2, '2165-02-01', 'Ex fuga Accusamus animi qui dignissimos velit dolor quia velit', 'Dolor et quod ut aut adipisicing est ullamco commodo officiis accusantium', '+623-66-4499054', 'Nobis molestiae mollitia ullamco', 'Calilabad Rayonu', 'Eveniet', 'Azerbaijan', '2017-03-22 20:32:12', '2017-03-22 20:32:53'),
(28, 28, 23, 'Jana', 'Casey', '3c1b2b50-4002-489e-b92f-8fa8e7713e23/1648f4e01b50d7629559b12f42d6dbc6.jpg', 1, '2165-02-01', 'Velit enim ipsum ex excepteur nihil sunt est error qui omnis tempor sit', 'Est voluptatibus nisi fugit magni architecto consequatur eos veniam Nam necessitatibus officiis est', '+765-99-8543888', 'Sapiente aut error earum nisi ut', 'Reunion', 'Totam la', 'Reunion', '2017-03-22 20:32:21', '2017-03-22 20:33:52'),
(29, 29, 23, 'Mercedes', 'Boyle', 'ba76f51a-d202-4ab0-990b-7133a18cca63/PF_15_R118X2_MINIMAL_NOGYP_NOFERN_VA1104_W1_SQ.jpg', 2, '2165-02-01', 'Animi enim quo dignissimos necessitatibus est consequatur sit rerum adipisicing occaecat quidem nihil adipisci odio quae repellendus', 'Incidunt omnis est aspernatur quo ut mollit', '+267-35-7015972', 'Sequi dolorem adipisicing suscip', 'Howland Island', 'Nostrum ', 'Howland Island', '2017-03-22 20:32:29', '2017-03-22 20:34:02'),
(30, 30, 23, 'Sierra', 'Bryan', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2017-03-22 20:37:05', '2017-03-22 20:37:05'),
(31, 31, NULL, 'Caryn', 'Hamilton', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2017-03-31 23:12:17', '2017-03-31 23:12:17'),
(32, 32, 23, 'Simone', 'Keller', 'e4f91ea3-495a-4550-ab35-66fc93bcb2a7/Pet-Birds-15.jpg', 1, '2165-02-01', 'Quasi obcaecati perspiciatis eveniet perferendis magni sapiente quis', 'Rem sed minima qui omnis quos voluptatum omnis quidem ad vel incidunt voluptatem dolores commodo dolorem recusandae Et consectetur', '+764-44-5736210', 'Necessitatibus elit quisquam la', 'Birzu Rajonas', 'Dolor do', 'Lithuania', '2017-03-31 23:13:31', '2017-11-22 19:31:27'),
(33, 33, NULL, 'Emma', 'Strong', '0ffa4a5f-9340-4fc0-8f02-dc415dd7eb52/favicon.ico', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2017-04-01 09:07:55', '2017-11-22 19:31:09'),
(35, 35, 23, 'General', 'User', NULL, 1, '2165-02-01', 'Reiciendis voluptas inventore corrupti voluptatem duis a aperiam vel odit similique ut sed quis placeat omnis quaerat beatae velit', '', '+823-74-3757551', 'Impedit voluptas odio eligendi ', 'Nova Gorica', 'Elit qu', 'Slovenia', '2017-04-01 09:15:30', '2017-04-01 09:15:30'),
(36, 36, 23, 'Lillith', 'Thornton', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2017-05-04 18:58:15', '2017-05-04 18:58:15'),
(37, 37, NULL, 'Vincent', 'Soto', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2017-06-03 08:48:56', '2017-06-03 08:48:56'),
(38, 38, NULL, 'Sohel', 'Rana', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2017-06-03 09:02:39', '2017-06-03 09:02:39'),
(39, 39, 23, 'Leah', 'Sanchez', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2017-06-03 22:30:14', '2017-06-03 22:30:14');

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`id`, `user_id`, `name`, `slug`, `description`, `deadline`, `status`, `note`, `created`, `last_opened`, `modified`) VALUES
(1, 23, 'Implement oAuth 2 Server', 'implement-oauth-2-server', 'Vivamus suscipit tortor eget felis porttitor volutpat. Quisque velit nisi, pretium ut lacinia in, elementum id enim. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec sollicitudin molestie malesuada. Praesent sapien massa, convallis a pellentesque nec, egestas non nisi. Curabitur aliquet quam id dui posuere blandit. Donec rutrum congue leo eget malesuada. Curabitur non nulla sit amet nisl tempus convallis quis ac lectus. Sed porttitor lectus nibh. Donec rutrum congue leo eget malesuada.', '2018-01-31', 1, 'Vivamus suscipit tortor eget felis porttitor volutpat. Quisque velit nisi, pretium ut lacinia in, elementum id enim. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec sollicitudin molestie malesuada. Praesent sapien massa, convallis a pellent', '2017-11-22 19:21:04', '2017-11-22 19:22:55', '2017-11-22 19:22:55'),
(2, 23, 'PSD to HTML Conversion', 'psd-to-html-conversion', 'PSD to HTML Conversion', '2018-01-06', 1, '', '2017-11-22 19:24:55', '2017-11-22 19:25:47', '2017-11-22 19:25:47'),
(3, 23, 'Build Custom CRM', 'build-custom-crm', 'Build Custom CRM', '2018-05-31', 1, '', '2017-11-22 19:26:37', '2017-11-22 19:28:02', '2017-11-22 19:28:02');

--
-- Dumping data for table `projects_users`
--

INSERT INTO `projects_users` (`id`, `project_id`, `user_id`, `status`, `created`, `modified`) VALUES
(1, 1, 39, 1, '2017-11-22 19:22:08', '2017-11-22 19:22:08'),
(2, 1, 24, 1, '2017-11-22 19:22:11', '2017-11-22 19:22:11'),
(3, 2, 35, 1, '2017-11-22 19:25:45', '2017-11-22 19:25:45'),
(4, 3, 33, 1, '2017-11-22 19:27:57', '2017-11-22 19:27:57'),
(5, 3, 29, 1, '2017-11-22 19:28:00', '2017-11-22 19:28:00');

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`id`, `identity`, `uuid`, `project_id`, `created_by`, `task`, `description`, `status`, `modified`, `created`) VALUES
(1, 1, '187911a4-951b-4bc8-904c-1000d046576b', 1, 23, 'Analysis requirement based on RFC', NULL, 1, '2017-11-22 19:23:18', '2017-11-22 19:23:18'),
(2, 2, '520d49e6-9ca6-4e2c-931d-dfee450fc2fb', 1, 23, 'Deploy a new server', NULL, 1, '2017-11-22 19:23:42', '2017-11-22 19:23:42'),
(3, 3, '83e52ec9-bd66-44f5-bc59-8d97b1c70ee6', 1, 23, 'Fixed the design issue', NULL, 2, '2017-11-22 19:24:12', '2017-11-22 19:24:01'),
(4, 1, '4438b4d4-b92e-4a32-b6bc-0e59ea519ac0', 3, 23, 'Fixed the website header', NULL, 1, '2017-11-22 19:28:31', '2017-11-22 19:28:31'),
(5, 2, '6979d11a-e89d-4f13-bad0-4ea44a6edc73', 3, 23, 'Fixed the Responsive Issue', NULL, 1, '2017-11-22 19:28:49', '2017-11-22 19:28:49'),
(6, 3, '70b0438e-557d-4e40-bbe6-0ed26f551e1b', 3, 23, 'Implement cPanel Apis', NULL, 1, '2017-11-22 19:29:09', '2017-11-22 19:29:09'),
(7, 4, '7c3b05c4-03b4-4061-a2d1-2709132bbbdc', 3, 23, 'Complete the CRUD of customers', NULL, 1, '2017-11-22 19:30:19', '2017-11-22 19:30:19');

--
-- Dumping data for table `tasks_labels`
--

INSERT INTO `tasks_labels` (`id`, `task_id`, `label_id`, `created`, `modified`) VALUES
(1, 1, 3, '2017-11-22 19:23:18', '2017-11-22 19:23:18'),
(2, 2, 1, '2017-11-22 19:23:42', '2017-11-22 19:23:42'),
(3, 3, 2, '2017-11-22 19:24:01', '2017-11-22 19:24:01'),
(4, 4, 6, '2017-11-22 19:28:31', '2017-11-22 19:28:31'),
(5, 4, 9, '2017-11-22 19:28:31', '2017-11-22 19:28:31'),
(6, 5, 6, '2017-11-22 19:28:49', '2017-11-22 19:28:49'),
(7, 6, 7, '2017-11-22 19:29:09', '2017-11-22 19:29:09'),
(8, 7, 12, '2017-11-22 19:30:19', '2017-11-22 19:30:19');

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `uuid`, `username`, `password`, `role`, `status`, `email_verifying_code`, `forgot_pass_code`, `email_verify`, `created`, `modified`) VALUES
(23, '80d0eeb0-9612-47dd-a718-c7c1cb0da07d', 'admin@example.com', '$2y$10$.MRfQaZr1IHCmmayPOIuueqscUixx0E6GFvIEJEHyHo9VoELyAXqe', 1, 1, NULL, NULL, 0, '2017-03-22 20:19:26', '2017-11-22 19:30:38'),
(24, 'f0dae69d-c3bb-4c99-9065-3c954c5d90e6', 'cyxihuw@gmail.com', '$2y$10$p3m3CyGc7ADIGvSAGKDixuhxgj9DYtQPDFDCYKqBgbI6pc0O1.o1G', 2, 1, 'cec18e3c-a70e-4c3a-83a1-6bfbb5dc', NULL, 0, '2017-03-22 20:21:43', '2017-03-22 20:31:22'),
(25, 'd8b17ee7-737e-4e20-879b-8cc0ba0ab93b', 'nelycilih@gmail.com', '$2y$10$e0NB3p6xFtULrUoYmfk7EetNY6psyFgDu3Rs/yulo.PtGswK7MqU.', 2, 1, '60f6e320-19ee-4f52-bab6-94901779', NULL, 0, '2017-03-22 20:22:07', '2017-04-22 12:25:10'),
(26, '203d8686-47ee-478d-b155-9b5575e3c997', 'ariful@previewtechs.com', '$2y$10$C8TuRT7vqvAN2.CSNcGxeO/rcMtEvgqTDRDL.5yWO/DzjpDvBjAhG', 1, 1, '785d8825-9078-4788-998f-1f797566', NULL, 0, '2017-03-22 20:23:13', '2017-03-22 20:31:45'),
(27, 'a6fb4459-a8cb-4b74-afe2-b9c335edc22a', 'zycej@yahoo.com', '$2y$10$5YX7cmzMGlDff1oesZ9MYe.3e0tQcAf6HJu60WaYdpx2ujlM6yEcq', 1, 1, 'a2dabf96-3ade-475b-b211-c5b2c14d', NULL, 0, '2017-03-22 20:32:12', '2017-03-22 20:32:53'),
(28, '3c1b2b50-4002-489e-b92f-8fa8e7713e23', 'pucuqonawo@gmail.com', '$2y$10$tXPv.F7mloDM.YOkahOAvussw7tLKqO1DVVj7jwsomIXSC.YrnKsu', 2, 1, '1f4cb856-e3e5-44bc-a3a6-221de900', NULL, 0, '2017-03-22 20:32:21', '2017-03-22 20:33:52'),
(29, 'ba76f51a-d202-4ab0-990b-7133a18cca63', 'lijybyj@yahoo.com', '$2y$10$eV1wmJT.kCRZatS35CK71.OBKlmgApfuwFivgvj2cRntjk8UyiA.e', 1, 1, '3c6d1c2c-d2d8-4b28-a8fa-864a0862', NULL, 0, '2017-03-22 20:32:29', '2017-03-22 20:34:02'),
(30, 'ce7cfe4e-72b8-4d0e-ab0d-2821e981125b', 'coxyzixo@yahoo.com', '$2y$10$Nlv7REVci4/Z7I6AFWcC8OhkXnuUkTXO..MOEmO/1QD5Xd5DuuSpe', 2, 1, NULL, NULL, 0, '2017-03-22 20:37:05', '2017-03-22 20:37:05'),
(31, 'c55706c4-cea8-4c48-9247-fb0b57619a6e', 'cotizygo@gmail.com', '$2y$10$xVX5Z/hnJrTRJtgUYwOnKeWsWa./2.wF.fK0KEYqcHeAKbKwSUAjG', 1, 1, NULL, NULL, 0, '2017-03-31 23:12:17', '2017-03-31 23:12:17'),
(32, 'e4f91ea3-495a-4550-ab35-66fc93bcb2a7', 'gicizes@gmail.com', '$2y$10$6yJxgKeNxnyVhlwH0jsWFOSEf4cXI2Esu3VqRgt6P9sXRDqbnLFEK', 1, 1, '7623d31e-fb6f-40cb-85f5-beb8c029', NULL, 0, '2017-03-31 23:13:31', '2017-11-22 19:31:27'),
(33, '0ffa4a5f-9340-4fc0-8f02-dc415dd7eb52', 'botireki@gmail.com', '$2y$10$.MRfQaZr1IHCmmayPOIuueqscUixx0E6GFvIEJEHyHo9VoELyAXqe', 2, 1, 'bbf5d1cf-494e-42c3-a221-7c8b0ac6', NULL, 0, '2017-04-01 09:07:55', '2017-11-22 19:31:09'),
(35, '2a8debb6-051b-410e-b75b-7000664d299c', 'user@example.com', '$2y$10$Z5b46LqKiAoNHGZHDLOAXedeLldFoNyyQ9qQ0GRJfxQeSryJsRuNK', 2, 1, '8b6b9d16-a396-4d13-9ecb-a624a7c9', NULL, 0, '2017-04-01 09:15:30', '2017-04-01 09:15:30'),
(36, '0c5c6171-8008-4290-9932-dd129196d0d4', 'fyhejob@hotmail.com', '$2y$10$mIDouttDntm.kh2XgNiNDubHnjWPAqJEQgELFLuauf7qev.xuSTYm', 2, 1, NULL, NULL, 0, '2017-05-04 18:58:15', '2017-05-04 18:58:15'),
(37, '28ceaf17-917f-4fa9-9f0c-170dc3e92281', 'sidyretuv@gg.com', '$2y$10$bvnn9N.8oI/oNlrseeFT5eCAtyIIUDXA9caGNqLAbKZ5QcYMcD7JO', 1, 1, NULL, NULL, 0, '2017-06-03 08:48:56', '2017-06-03 08:48:56'),
(38, 'ad0f4db6-ffd1-46c9-8936-81f9cd4bc5d8', 'me.ssohddelrana@gmail.com', '$2y$10$vqpK4s9VDfvkNFsBF4yYMOowIaBNm00yz7YrD1NARbyxfKwYAToK2', 1, 1, NULL, NULL, 0, '2017-06-03 09:02:39', '2017-06-03 09:02:39'),
(39, 'b4a71476-daab-4597-ae80-40bcfd615046', 'vadyz@yahoo.com', '$2y$10$cVhrQ2KNegRzZqLuZkJiUO9lUsSmz2S0cVg90hvB8bmIrKXVpQA/m', 2, 1, NULL, NULL, 0, '2017-06-03 22:30:14', '2017-06-03 22:30:14');

--
-- Dumping data for table `users_tasks`
--

INSERT INTO `users_tasks` (`id`, `user_id`, `task_id`, `created`, `modified`) VALUES
(1, 39, 1, '2017-11-22 19:23:18', '2017-11-22 19:23:18'),
(2, 39, 2, '2017-11-22 19:23:42', '2017-11-22 19:23:42'),
(3, 24, 3, '2017-11-22 19:24:01', '2017-11-22 19:24:01'),
(4, 39, 3, '2017-11-22 19:24:01', '2017-11-22 19:24:01'),
(5, 29, 4, '2017-11-22 19:28:31', '2017-11-22 19:28:31'),
(6, 33, 4, '2017-11-22 19:28:31', '2017-11-22 19:28:31'),
(7, 33, 5, '2017-11-22 19:28:49', '2017-11-22 19:28:49'),
(8, 33, 6, '2017-11-22 19:29:09', '2017-11-22 19:29:09'),
(9, 29, 7, '2017-11-22 19:30:19', '2017-11-22 19:30:19');
