composer install
npm i
symfony console doctrine:database:create
symfony console make:migration
symfony console doctrine:migrations:migrate
symfony console doctrine:fixtures:load

dans la bdd directement faire la requete pour inserer un admin (sur phpmyadmin par exemple)
INSERT INTO `user` (`id`, `email`, `roles`, `password`) VALUES (NULL, 'a@gmail.com', '[\"ROLE_USER\"]', '$argon2id$v=19$m=65536,t=4,p=1$DTiibio1G5jnNsCjN3MTUA$VqCEz7hmYbV0t6Xkix5z0TnAtVvSOUplovhfinyEaJY');

symfony server:start
npm run watch
