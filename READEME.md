SELECT * FROM `order` INNER JOIN reservation ON `order`.reservation_id = reservation.id INNER JOIN `menu_item` ON `order`.`menu_item_code` = menu_item.menu_item_code WHERE `reservation_id` = ?

<h3>Voeg een `id` row toe aan de tabel `order`</h3>