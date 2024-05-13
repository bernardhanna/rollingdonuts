git checkout develop
git add .           
git commit -am "09-05-2024"
git push

git checkout main   
git pull origin main        
git merge develop

====================
Digital Ocean
====================

git config --global user.email "bernard@matrixinternet.ie"
git config --global user.name "bernardhanna"land
cd /var/www/
sudo chown -R www-data:www-data html
cd /var/www/html

git checkout main
git add .
git commit -m "Fix to the Added to cart message"
git pull
yarn build
cd /var/www/
sudo chown -R www-data:www-data html
