
Jednoduchá fotogalerie vytvořená v Laravelu. Umožňuje uživatelům nahrávat, zobrazovat fotografie.   

![Screenshot aplikace]![image](https://github.com/user-attachments/assets/eae7e761-5326-4e02-9eb9-391e7876a1ec)


## ✨ Funkce aplikace  

✅ Nahrávání fotek s popiskem  
✅ Galerie s možností mazání fotografií  
✅ Vyhledávání fotografií podle názvu  
✅ Responzivní design postavený na **Tailwind CSS**  
✅ Použití databáze **SQLite**  

---
 Jak aplikaci spustit?  

### 🛠 1. Naklonování projektu  
Nejdříve si stáhni projekt z GitHubu:  
```bash
git clone https://github.com/username/tvuj-repo.git
cd tvuj-repo
```

 2. Instalace závislostí  
Aplikace používá **Composer** (pro PHP knihovny) a **npm** (pro frontend).  
Spusť tyto příkazy:  
```bash
composer install
npm install
npm run build
```

 3. Konfigurace `.env`  
1Zkopíruj **.env.example** a přejmenuj na **.env**:  
```bash
cp .env.example .env
```
2️Uprav **.env** soubor:  

```
APP_NAME="Fotogalerie"
APP_ENV=local
APP_KEY=
APP_URL=http://localhost
DB_CONNECTION=sqlite
DB_DATABASE=database/database.sqlite
```
 4. Generování aplikačního klíče  
```bash
php artisan key:generate
```
 5. Vytvoření databáze a migrace  
```bash
touch database/database.sqlite
php artisan migrate
```
6. Spuštění aplikace  
```bash
php artisan serve
```
bimbum a hotovo 🎉  

