<?php

//DELETE c FROM products p RIGHT JOIN categories c ON p.category_id = c.id
//WHERE p.id IS NULL;

//DELETE p FROM availabilities a RIGHT JOIN products p ON a.product_id = p.id
//WHERE a.id IS NULL;

//DELETE s FROM availabilities a JOIN products p ON a.product_id = p.id
//RIGHT JOIN stocks s ON a.stock_id = s.id
//WHERE p.id IS NULL;