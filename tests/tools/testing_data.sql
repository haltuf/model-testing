# Enforce database name
# To prevent accidentally deleting live data
USE `mt_test`;

SET FOREIGN_KEY_CHECKS=0;
TRUNCATE TABLE `mt_test`.`category`;
TRUNCATE TABLE `mt_test`.`product`;
SET FOREIGN_KEY_CHECKS=1;

INSERT INTO `category` (`id`, `name`, `url`, `visible`) VALUES
(1, 'Fotoaparáty TEST', 'foto', 1),
(2, 'Objektivy TEST', 'objektivy', 1),
(3, 'Příslušenství TEST', 'prislusenstvi', 0);

INSERT INTO `product` (`id`, `name`, `price`, `url`, `category_id`) VALUES
(1, 'Nikon D5300 TEST', '13999.00', 'nikon-d5300', 1),
(2, 'Krytka objektivu Nikon TEST', '499.00', 'krytka-objektivu-nikon', 3),
(3, 'Nikon D850 TEST', '79999.00', 'nikon-d850', 1),
(4, 'Nikon 200-500 mm f/5,6E ED VR TEST', '29999.00', 'nikon-200-500mm-f-5-6e-ed-vr', 2),
(5, 'Canon EOS 5D Mark IV TEST', '55499.00', 'canon-eos-5d-mark-iv', 1),
(6, 'Nikon 35 mm f/1,8 AF-S G TEST', '14999.00', 'nikon-35-1-8-af-s-g', 2),
(7, 'Krytka objektivu Canon TEST', '459.00', 'krytka-objektivu-canon', 3);