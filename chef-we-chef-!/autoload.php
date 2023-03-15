<?php

require "services/Router.php";

require "controllers/AbstractController.php";
require "controllers/ChiefController.php";
require "controllers/DishController.php";
require "controllers/DefaultController.php";

require "managers/AbstractManager.php";
require "managers/ChiefManager.php";
require "managers/DishManager.php";
require "managers/FoodStyleManager.php";
require "managers/CategoryManager.php";

require "models/Chief.php";
require "models/Dish.php";
require "models/FoodStyle.php";
require "models/Category.php";

// Media
require "models/media/Media.php";
require "models/media/RandomStringGenerator.php";
require "models/media/Uploader.php";