# TODO: Translate Add Services, Add Vehicles, Supplies, and Users Pages to English

## Step 1: Update lang.php
- [x] Add new translation keys for add services, add vehicles, supplies, and users pages in both 'es' and 'en' arrays:
  - Add services page keys (e.g., 'title_add_services', 'service_information', 'add_service', 'service_name', etc.)
  - Add vehicles page keys (e.g., 'title_add_vehicles', 'vehicle_information', 'add_vehicle', 'chassis_number', etc.)
  - Supplies page keys (e.g., 'title_supplies', 'supply_information', 'add_supply', 'price', etc.)
  - Users page keys (e.g., 'title_users', 'users', 'id', 'name', 'last_name', 'email', 'phone', 'role', 'actions', 'edit', 'user_email', 'new_profile', 'admin', 'client', 'center', 'update_role', 'role_updated_successfully')

## Step 2: Update addservicios/svadd.php
- [x] Include lang.php after session_start()
- [x] Make HTML lang attribute dynamic: <html lang="<?php echo $lang; ?>">
- [x] Update page title to use t('title_add_services')
- [x] Replace hardcoded navbar links with t() calls
- [x] Update form labels, buttons, headings, table headers, and messages to use t() calls
- [x] Update popup titles and labels to use t() calls

## Step 3: Update aautos/aautos.php
- [x] Include lang.php after session_start()
- [x] Make HTML lang attribute dynamic: <html lang="<?php echo $lang; ?>">
- [x] Update page title to use t('title_add_vehicles')
- [x] Replace hardcoded navbar links with t() calls
- [x] Update form labels, buttons, headings, table headers, and messages to use t() calls
- [x] Update popup titles and labels to use t() calls

## Step 4: Update insumos/insumos.php
- [x] Include lang.php after session_start()
- [x] Make HTML lang attribute dynamic: <html lang="<?php echo $lang; ?>">
- [x] Update page title to use t('title_supplies')
- [x] Replace hardcoded navbar links with t() calls
- [x] Update form labels, buttons, headings, and messages to use t() calls
- [x] Update modal titles and labels to use t() calls

## Step 5: Update allusr/usuarios.php
- [x] Include lang.php after session_start()
- [x] Make HTML lang attribute dynamic: <html lang="<?php echo $lang; ?>">
- [x] Update page title to use t('title_users')
- [x] Replace hardcoded navbar links with t() calls
- [x] Update table headers, form labels, buttons, and messages to use t() calls

## Step 6: Test the Changes
- [x] Load each page in a browser
- [x] Switch language via ?lang=en or ?lang=es and verify translations
- [x] Check for PHP syntax errors
- [x] Fix language persistence issue by adding ?lang= parameter to all navigation links
