git checkout develop
git add .           
git commit -am "02-02-2024"
git push

git checkout main   
git pull origin main        
git merge develop

====================
Digital Ocean
====================

cd /var/www/html

git checkout main
git pull

yarn build
