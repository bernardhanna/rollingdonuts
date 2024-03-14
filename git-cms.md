git checkout develop
git add .           
git commit -am "14-03-2024"
git push

git checkout main   
git pull origin main        
git merge develop

====================
Digital Ocean
====================

git config --global user.email "bernard@matrixinternet.ie"
git config --global user.name "bernardhanna"
cd /var/www/
sudo chown -R www-data:www-data html
cd /var/www/html

git checkout main
git add .
git commit -m "todays changes"
git pull
yarn build
