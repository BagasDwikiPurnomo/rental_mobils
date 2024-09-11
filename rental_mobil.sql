-- Adminer 4.8.1 MySQL 9.0.1 dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

DROP DATABASE IF EXISTS `rental_mobil`;
CREATE DATABASE `rental_mobil` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;

USE `rental_mobil`;

DROP TABLE IF EXISTS `cars`;
CREATE TABLE `cars` (
  `car_id` int NOT NULL AUTO_INCREMENT,
  `logo` varchar(255) NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `merk` varchar(255) NOT NULL,
  `date` year NOT NULL,
  `engine` varchar(255) NOT NULL,
  `transmission` varchar(255) NOT NULL,
  `drivetrain` varchar(255) NOT NULL,
  `inter_exter` varchar(255) NOT NULL,
  `seats` int NOT NULL,
  `price_rent` int NOT NULL,
  `other_photo` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `overview_introduction` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `primary_feature` varchar(255) NOT NULL,
  `additional_feature` varchar(255) NOT NULL,
  `body_type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `fuel_type` varchar(255) NOT NULL,
  `consumption` varchar(255) NOT NULL,
  `power` varchar(255) NOT NULL,
  PRIMARY KEY (`car_id`,`name`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `cars` (`car_id`, `logo`, `name`, `merk`, `date`, `engine`, `transmission`, `drivetrain`, `inter_exter`, `seats`, `price_rent`, `other_photo`, `overview_introduction`, `primary_feature`, `additional_feature`, `body_type`, `fuel_type`, `consumption`, `power`) VALUES
(1,	'https://i.imgur.com/wQgUwLB.jpeg',	'BMW 320i',	'BMW',	'2023',	'2.0L Inline-4 Turbocharged',	'Automatic',	'RWD',	'Luxurious interior with high-quality materials, elegant and sporty exterior with aerodynamic design.',	5,	999000,	'https://i.pinimg.com/564x/28/fa/27/28fa276cbde9870ec053b6ae87072cea.jpg,\r\nhttps://i.pinimg.com/564x/2d/87/85/2d878586851766a7aa1cc75403c6eef4.jpg,\r\nhttps://i.pinimg.com/564x/64/f5/33/64f533fc2f447ec5059033982f46602c.jpg,\r\nhttps://i.pinimg.com/564x/21/fe/bc/21febc0cc2dc6b2d60cf4726da2b1cd4.jpg,\r\nhttps://i.pinimg.com/564x/a8/83/85/a88385aa74db71638f63de61dac556c5.jpg',	'BMW 320i is part of the 3 Series, known for its blend of performance, luxury, and advanced technology.                                                                                                                                                                                                                                                                                                                                                                                                                                                                ',	'iDrive infotainment system\r\nadaptive cruise control\r\nand dynamic stability control                                                                                                                                                                             ',	'Leather upholstery\r\nambient lighting\r\nheated front seats.',	'Sedan',	'Petrol',	'26',	'181'),
(11,	'https://i.imgur.com/8yILrdA.jpeg',	'BMW M4 Competition',	'BMW',	'2023',	'3.0L M TwinPower Turbo Inline-6',	'Automatic',	'RWD',	'Merino leather upholstery, M Carbon bucket seats',	4,	3500000,	'https://res.cloudinary.com/mufautoshow/image/upload/f_auto/v1688638621/moas/news/BMW-M4-Competition-Coup%C3%A9_Interior.png,https://i.imgur.com/iCrtq4p.png,https://i.imgur.com/Ui9XDwh.png,https://i.imgur.com/gaPWrTu.png',	'The BMW M4 Competition is a high-performance variant of the M4, offering extreme performance with striking design and advanced technology. It is designed for driving enthusiasts who seek a highly responsive and dynamic driving experience.                                                        ',	'M xDrive all-wheel drive (optional)\r\nAdaptive M suspension\r\nM Compound brakes\r\nM Drive Professional (driving dynamics features)                                                        ',	'BMW iDrive 7.0 infotainment system\r\nHarman Kardon surround sound system\r\nM Carbon exterior package\r\nHead-Up Display\r\nGesture control',	'Coupe',	'Petrol',	'10.2',	'503'),
(14,	'https://i.imgur.com/VvnrtMO.jpeg',	'BMW X5',	'BMW',	'2024',	'2.0L Inline-4 Turbocharged',	'Automatic',	'AWD',	'Premium leather, panoramic sunroof',	5,	2300000,	'https://www.bmw.co.id/content/bmw/marketID/bmw_co_id/en_ID/all-models/x-series/X5/2023/bmw-x5-highlights/jcr:content/par/multicontent_1720712702/tabs/multicontenttab/items/smallteaser/image.transform/smallteaser/image.1676566186535.jpg,\r\nhttps://www.bmw.co.id/content/dam/bmw/common/all-models/x-series/x5/2023/highlights/bmw-X-series-x5-gallery-video-comfort-functionality-02.jpg,\r\nhttps://imgcdn.oto.com/large/gallery/interior/3/2150/bmw-x5-front-seats-979490.jpg,\r\nhttps://imgcdn.oto.com/large/gallery/exterior/3/2150/bmw-x5-wheel-904286.jpg,\r\nhttps://cdni.autocarindia.com/Utils/ImageResizer.ashx?n=https://cdni.autocarindia.com/ExtraImages/20230714060800_BMW_X5_facelift_rear.jpg',	'The BMW X5 is a mid-size luxury SUV known for its powerful performance and spacious interior.                                                                                    ',	'iDrive 7.0\r\nadaptive LED headlights                                                                                    ',	'Harman Kardon audio system\r\nadaptive suspension',	'SUV',	'Petrol',	'8.5',	'335'),
(15,	'https://i.imgur.com/rW3daH7.jpeg',	'BMW X3',	'BMW',	'2024',	'2.0L Turbocharged Inline-4',	'Automatic',	'AWD',	'Wood trim, LED headlights',	5,	1900000,	'https://bmw.astra.co.id/wp-content/uploads/2022/06/P90424707_lowRes_the-new-bmw-x3-xdriv.jpg,\r\nhttps://i0.wp.com/bmwstore.id/wp-content/uploads/2024/06/P90424708_lowRes_the-new-bmw-x3-xdriv-edited.jpg?resize=750%2C562&ssl=1,\r\nhttps://www.bmw.co.id/content/dam/bmw/common/all-models/x-series/x3/2021/onepager/bmw-x3-onepager-gallery-interieur-01.jpg,\r\nhttps://www.bmw-tunas.co.id/wp-content/uploads/2023/10/bmw-x3-m-sport-bekas-8.webp,\r\nhttps://www.topgear.com/sites/default/files/2024/06/M50_C2C_3272.jpg',	'The BMW X3 is a compact luxury SUV offering a balance of performance and practicality.                                                        ',	'iDrive 7.0\r\nadvanced safety systems                                                        ',	'Dual-zone climate control\r\nparking sensors',	'SUV',	'Petrol',	'7.6',	'248'),
(16,	'https://i.imgur.com/rt5A6FP.jpeg',	'BMW 530i',	'BMW',	'2024',	'2.0L Turbocharged Inline-4',	'Automatic',	'RWD',	'Nappa leather, adaptive LED headlights',	5,	2000000,	'https://mbtech.info/asset/uploads/gallery/FA-IMG_8066.jpg,\r\nhttps://www.bmw-tunas.co.id/wp-content/uploads/2023/05/Eksterior-BMW-520i-dan-530i-BMW-Adaptive-LED.webp,\r\nhttps://www.seva.id/wp-content/uploads/2022/07/FA-IMG_8015-1.jpg,\r\nhttps://s3.ap-southeast-1.amazonaws.com/moladin.assets/blog/wp-content/uploads/2022/06/30212240/WhatsApp-Image-2022-06-30-at-9.12.51-PM.jpeg,\r\nhttps://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcREd2tLIn2HjIzZI1JN3RmQ-CtA9MibRBQ2wPv67kuZz2sufXpB-oRkWVihxcAq_dZ-Mdw&usqp=CAU,\r\nhttps://i.ytimg.com/vi/EC6aGmDrx6g/maxresdefault.jpg',	'The BMW 530i is a mid-size luxury sedan known for its elegant design and smooth ride.                            ',	'iDrive 7.0\r\nHarman Kardon sound system                            ',	' Heads-up display\r\nadaptive cruise control',	'Sedan',	'Petrol',	'6.9',	'248'),
(17,	'https://images.autofun.co.id/file1/6d271d8546b04f209977e74bd5f0b958_1125x630.jpeg',	'Mercedes-Benz C200',	'Mercedes',	'2024',	'2.0L Turbocharged Inline-4',	'Automatic',	'RWD',	'Leather seats, ambient lighting',	5,	1900000,	'https://s3.ap-southeast-1.amazonaws.com/moladin.assets/blog/wp-content/uploads/2022/07/14220322/mercedes-benz-c200-w206-interior.jpg,\r\nhttps://awsimages.detik.net.id/community/media/visual/2022/07/14/mercedes-benz-c-class-w206-4.jpeg?w=1616,\r\nhttps://autonetmagz.com/wp-content/uploads/2022/03/mercedes-benz-c200-w206-engine.jpg,\r\nhttps://asset-3.tstatic.net/jualbeli/img/2023/1/2597729/1-1814253946-Mercedes-Benz-C200-2017-------Tangan-Pertama-Dari-Baru.jpg,\r\nhttps://awsimages.detik.net.id/community/media/visual/2022/07/14/mercedes-benz-c-class-w206-1.jpeg?w=1616,\r\nhttps://pictures.dealer.com/m/mercedesbenzofhuntvalleymb/0761/2a423d912eceee8ed1ddc4e023d8dd85x.jpg',	' The Mercedes-Benz C200 is a compact luxury sedan that offers a refined driving experience and advanced technology.                            ',	'MBUX infotainment system \r\nadvanced driver assistance systems                            ',	'Panoramic sunroof\r\nwireless charging',	'SUV',	'Petrol',	'6.5',	'201'),
(18,	'https://i.imgur.com/7xm5tNg.jpeg',	'Mercedes-Benz GLE 350',	'Mercedes',	'2024',	'2.0L Turbocharged Inline-4',	'Automatic',	'AWD',	'Leather upholstery, LED headlights',	5,	2300000,	'https://di-uploads-pod1.dealerinspire.com/mercedesbenzofstcharles/uploads/2019/09/mercedes-benz-gle-350-interior.jpg,\r\nhttps://docs.spm247.com/ftpcs/2021/Mercedes-Benz/GLE/2021MBGLE-exterior-01.jpg,\r\nhttps://images.clickdealer.co.uk/vehicles/6131/6131174/large1/145341283.jpg,\r\nhttps://vehicle-images.dealerinspire.com/ea72-21001055/4JGFB4FB5RB108826/731589307a408df38f352e3d2f5f7a18.jpg,\r\nhttps://di-uploads-pod3.dealerinspire.com/rbmofalpharettamercedesbenz/uploads/2017/03/2017-Mercedes-Benz-GLE350-Interior.jpg',	'The Mercedes-Benz GLE 350 is a mid-size luxury SUV known for its comfort, technology, and performance.                            ',	'MBUX infotainment\r\nadvanced safety features                            ',	'Burmester sound system\r\nadaptive suspension',	'SUV',	'Petrol',	'8.0',	'255'),
(19,	'https://i.imgur.com/qSA9Bsw.jpeg',	'Mercedes-Benz E-Class',	'Mercedes',	'2023',	'2.0L Turbocharged Inline-4',	'Automatic',	'RWD',	'Nappa leather, LED ambient lighting',	5,	2200000,	'https://static1.topspeedimages.com/wordpress/wp-content/uploads/2023/06/mercedes-benz-e-class-2024-1600-65.jpg,\r\nhttps://www.mercedesbenzofficial.com/file/e-class22-04.jpg,\r\nhttps://www.clickmercedesbenz.com/file/mercedes-benz-e-class-estate-grille-view.jpg,\r\nhttps://s3.ap-southeast-1.amazonaws.com/moladin.assets/blog/wp-content/uploads/2021/11/04120902/Foto-2-STAR-EXPO-2021.jpg,\r\nhttps://www.carimercedesbenz.com/file/mercedes-benz-e-class-estate-touch-screen.jpg',	'The Mercedes-Benz E-Class is a luxury sedan offering a combination of comfort, style, and cutting-edge technology.                                                                                    ',	'MBUX infotainment\r\ndriver assistance package                                                                                    ',	'Surround-view camera\r\nadaptive suspension',	'Sedan',	'Petrol',	'7.8',	'255'),
(20,	'https://i.imgur.com/158pVnY.jpeg',	'Mercedes-Benz S-Class',	'Mercedes',	'2024',	'3.0L Turbocharged Inline-6 with EQ Boost',	'Automatic',	'RWD',	'Premium leather, Burmester 3D surround sound',	5,	3500000,	'https://www.blackxperience.com/assets/content/blackauto/autonews/mercedes-benz-s-class-sumber-torquereport-4-ok.jpg,\r\nhttps://img.cintamobil.com/2021/06/14/E7uYC7dI/interior-s-class-1-c895.jpg,\r\nhttps://i.pinimg.com/originals/18/91/2d/18912d1822d3e16d7b9e9a3631302ce0.jpg,\r\nhttps://autonetmagz.com/wp-content/uploads/2020/09/mercedes-benz-s-class-2021-front.jpg,\r\nhttps://img.icarcdn.com/mobil123-news/body/62898-mercedes-benz-s500-amg-line-in.jpg',	'The Mercedes-Benz S-Class is the flagship luxury sedan, known for its opulent interior, cutting-edge technology, and exceptional ride comfort.                                                        ',	'MBUX Hyperscreen\r\nadvanced driver assistance                                                        ',	'Rear executive seating package\r\nambient lighting',	'Sedan',	'Petrol',	'8.2',	'429'),
(21,	'https://i.imgur.com/fzbIYLI.jpeg',	'Mercedes-Benz G-Class',	'Mercedes',	'2023',	'4.0L Twin-Turbocharged V8',	'Automatic',	'AWD',	'Leather upholstery, G-specific design',	5,	4500000,	'https://autonetmagz.com/wp-content/uploads/2017/05/interior-Mercedes-Benz-G-Class-exclusive-edition.jpg,\r\nhttps://www.clickmercedesbenz.com/file/mercedes-benz-g-class-w463_wallpaper_06_1920x1200_04-2016.jpg,\r\nhttps://www.marinoperformancemotors.com/imagetag/13090/18/l/Used-2014-Mercedes-Benz-G-Class-G-63-AMG.jpg,\r\nhttps://images.squarespace-cdn.com/content/v1/5a09a654e5dd5bcfe00c5f3a/1622626633553-65XR1ZPQERRVD9T2FRNX/DSC08073.jpg,\r\nhttps://image.made-in-china.com/202f0j00WgJkQsAZyqoc/Fit-for-Mercedes-Benz-G-Class-W463-2004-2018-Modified-to-W464-Amg-Style-with-Front-and-Rear-Bumper-Grille-Hood-Headlight-Taillight.webp',	'The Mercedes-Benz G-Class is an iconic luxury SUV, renowned for its off-road capabilities and unique design.                                                        ',	'G-Mode off-road settings\r\nadaptive suspension                                                        ',	'Night package\r\nsurround-view camera',	'SUV',	'Petrol',	'13.1',	'577'),
(22,	'https://i.imgur.com/reCnIKB.jpeg',	'BMW 840i',	'BMW',	'2024',	'3.0L TwinPower Turbo Inline-6',	'Automatic',	'RWD',	'Vernasca leather upholstery, ambient lighting',	4,	3000000,	'https://www.cnet.com/a/img/resize/eac81f409e8f2245be68abfc17b0b1b35ee5fc23/hub/2019/12/31/a65524ec-7b91-468c-99ca-9560930e7c71/2020-bmw-840i-coupe-131.jpg?auto=webp&width=1920,\r\nhttps://www.cnet.com/a/img/resize/ff2350354accfa2131dd0900fbda9ca64ca25895/hub/2019/09/21/8df48620-54cd-43e8-a151-7cdba9ef9b8e/2020-bmw-8-series-gran-coupe-020.jpg?auto=webp&width=1920,\r\nhttps://cdn.rnudah.com/images/plain/976304b8489baa5d65b2b75c11f3a346-2886289680049931196.jpg,\r\nhttps://cdn.rnudah.com/images/plain/8887f6c909be8bb8fc4f36342de6678a-2886289688761422378.jpg,\r\nhttps://www.bmw-tunas.co.id/wp-content/uploads/2022/12/Generously-proportioned-ambiance-of-bmw-840i-gran-coupe.webp',	'The BMW 840i is a luxurious grand tourer that combines elegant design with powerful performance. It offers a smooth ride, advanced technology, and a refined driving experience.                                                        ',	'BMW Live Cockpit Professional\r\nHarman Kardon surround sound system\r\nAdaptive M suspension\r\nGesture control                                                        ',	'Head-Up Display\r\nWireless charging\r\nSoft-close automatic doors\r\nM Sport differential',	'Coupe',	'Petrol',	'7.9',	'335'),
(23,	'https://cdn.motor1.com/images/mgl/7xQZW/s3/2021-mercedes-amg-gt-stealth-edition.jpg',	'Mercedes-Benz AMG GT',	'Mercedes',	'2024',	'4.0L Twin-Turbocharged V8',	'Automatic',	'RWD',	'AMG Performance seats, Nappa leather upholstery',	2,	4500000,	'https://hips.hearstapps.com/hmg-prod/images/2024-mercedes-amg-gt-coupe-interior-122-64da40b809fe6.jpg,\r\nhttps://mercteil.com/s3/amg-gt-led-static-headlights-genuine-mercedes-benz-1620824473828.jpg,\r\nhttps://avatars.mds.yandex.net/get-autoru-vos/2197701/7d820347bd2cc0c19a66ec7ee014fa10/456x342,\r\nhttps://www.topgear.com/sites/default/files/2023/08/2%20New%20Mercedes-AMG%20GT.jpg,\r\nhttps://i.pinimg.com/originals/fd/56/cc/fd56cc32f2062cae9cf296795662a41b.png,\r\nhttps://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRuYlpv4U_QJFU3e2SvjobYa8sOdQgIHIcB4Q&s',	'The Mercedes-Benz AMG GT is a high-performance sports car that embodies the spirit of the AMG brand. With its powerful V8 engine, dynamic handling, and striking design, it\'s built for driving enthusiasts.                            ',	'AMG RIDE CONTROL suspension\r\nAMG Performance Exhaust System\r\nAMG DYNAMIC SELECT with multiple driving modes                            ',	'Burmester surround sound system\r\nAMG Track Pace (performance data logger)\r\nCarbon ceramic brakes (optional)\r\nNight package (optional)',	'Coupe',	'Petrol',	'11.4',	'523')
ON DUPLICATE KEY UPDATE `car_id` = VALUES(`car_id`), `logo` = VALUES(`logo`), `name` = VALUES(`name`), `merk` = VALUES(`merk`), `date` = VALUES(`date`), `engine` = VALUES(`engine`), `transmission` = VALUES(`transmission`), `drivetrain` = VALUES(`drivetrain`), `inter_exter` = VALUES(`inter_exter`), `seats` = VALUES(`seats`), `price_rent` = VALUES(`price_rent`), `other_photo` = VALUES(`other_photo`), `overview_introduction` = VALUES(`overview_introduction`), `primary_feature` = VALUES(`primary_feature`), `additional_feature` = VALUES(`additional_feature`), `body_type` = VALUES(`body_type`), `fuel_type` = VALUES(`fuel_type`), `consumption` = VALUES(`consumption`), `power` = VALUES(`power`);

DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `user_id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(25) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `verif_token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `google_id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `role` varchar(25) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `user` (`user_id`, `username`, `email`, `password`, `verif_token`, `google_id`, `role`) VALUES
(10,	'bagas',	'bagas@gmail.com',	'$2y$10$rWOGIBmQ/tGLX17dIvFtDePN5AcAWAvXTrxEeeo9J.0b6TrhzLNbu',	'd732f64ef45c25d73f6b4d5cedc1c741',	'',	'admin'),
(11,	'rafi',	'rafiuniverse@gmail.com',	'$2y$10$1ktXFnJU5cZaHYP2QOn48uMklyL7O/jp3IwU8mIm1fJr0jWhdwgEC',	'71a911bc3bd215e48c3f90c8f4921bc8',	'',	'user'),
(12,	'bilal',	'bilal@gmail.com',	'$2y$10$fqMbpopWzR3/wgT345SkdeewRB4zitpC7l1iltVZeKP/2HK3meLFC',	'03a537195927dd1d25f5b52b4d329e47',	'',	'user'),
(13,	'bagass',	'bgstopiaa@gmail.com',	'$2y$10$B7J/ayYLS4mMiE5Rd6OFyuedFNgstJgA2bPGb/YTMtRkS7nrcJUk6',	'',	'',	'user'),
(24,	'admin',	'Admin@gmail.com',	'$2y$10$bl80zdKEeMaOqgKvvlx5Pe.LNwrNqHdNqXR9ATWWRGSMO5TuBUhEe',	'',	'',	'admin'),
(31,	'Tron',	'raf@gmail.com',	'$2y$10$3KSLsx3w3hv10teQiumE9OS5e5T1rhh8FbnrFG7vgdmEg6tilwPqm',	'',	'',	'user'),
(36,	'Tommy',	'brots@gmail.com',	'$2y$10$qysecQqrn2EbWJM7cqVdT.rF0JgdNjT5eQnjCIBpt2tlhmOa3Bole',	'a9e7d2cb720e02e66adbea93cb011cb0',	'',	'user')
ON DUPLICATE KEY UPDATE `user_id` = VALUES(`user_id`), `username` = VALUES(`username`), `email` = VALUES(`email`), `password` = VALUES(`password`), `verif_token` = VALUES(`verif_token`), `google_id` = VALUES(`google_id`), `role` = VALUES(`role`);

DROP TABLE IF EXISTS `rentals`;
CREATE TABLE `rentals` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `car_name` varchar(255) NOT NULL,
  `start_date` datetime NOT NULL,
  `end_date` datetime NOT NULL,
  `total_price` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `car_name` (`car_name`),
  CONSTRAINT `rentals_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`),
  CONSTRAINT `rentals_ibfk_2` FOREIGN KEY (`car_name`) REFERENCES `cars` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `rentals` (`id`, `user_id`, `car_name`, `start_date`, `end_date`, `total_price`) VALUES
(23,	11,	'BMW 320i',	'2024-01-08 13:30:00',	'2024-01-12 13:30:00',	4016000),
(24,	36,	'Mercedes-Benz C200',	'2024-08-08 14:45:00',	'2024-08-13 14:45:00',	9520000),
(25,	36,	'Mercedes-Benz E-Class',	'2024-04-08 16:45:00',	'2024-04-13 16:45:00',	11020000),
(27,	13,	'BMW 840i',	'2024-01-08 15:05:00',	'2024-01-10 15:05:00',	6020000)
ON DUPLICATE KEY UPDATE `id` = VALUES(`id`), `user_id` = VALUES(`user_id`), `car_name` = VALUES(`car_name`), `start_date` = VALUES(`start_date`), `end_date` = VALUES(`end_date`), `total_price` = VALUES(`total_price`);


-- 2024-08-25 03:34:40
