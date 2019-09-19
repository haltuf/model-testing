INSERT INTO `category` (`id`, `name`, `url`, `visible`) VALUES
(1, 'Fotoaparáty', 'foto', 1),
(2, 'Objektivy', 'objektivy', 1),
(3, 'Příslušenství', 'prislusenstvi', 0);

INSERT INTO `product` (`id`, `name`, `price`, `url`, `category_id`) VALUES
(1, 'Nikon D5300', '13999.00', 'nikon-d5300', 1),
(2, 'Nikon D850', '79999.00', 'nikon-d850', 1),
(3, 'Canon EOS 5D Mark IV', '55499.00', 'canon-eos-5d-mark-iv', 1),
(4, 'Nikon 200-500 mm f/5,6E ED VR', '29999.00', 'nikon-200-500mm-f-5-6e-ed-vr', 2),
(5, 'Nikon 35 mm f/1,8 AF-S G', '14999.00', 'nikon-35-1-8-af-s-g', 2),
(6, 'Krytka objektivu Nikon', '499.00', 'krytka-objektivu-nikon', 3),
(7, 'Krytka objektivu Canon', '459.00', 'krytka-objektivu-canon', 3);