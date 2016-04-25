# Changelog

## v3.5.0 (2016-04-25)
### Added
- customer candidate change to customer feature
- add some widget and data to dashboard
- minor improvement on sale form
- edit sale now can edit it's address and phone manually (temporer)
- new changelog

### Changed
- minor adjusting on login page
- minor adjusting on customer and customer candidates show
- minor adjusting on customer candidates index

### Fixed
- minor bug on search
- customer candidates delete routes missing
- version on changelog

## v3.4.3 (2016-04-22)
### Added
- DB: address and phone column to sale table
- Use datatables view in sales index

### Changed
- Customers index address, now show the customers laundry address instead of home address (if the customer had one)

### Fixed
- some pronouncations on customer repositories criteria
- sale update: not updating the quantity and nominal sale
- sale create: not sum up the total jerigent

## v3.4.2 (2016-04-21)
### Added
- check home or laundry address on print and csv template

### Fixed
- bug address column on create new sale

## v3.3.1 (2016-04-21)
### Added
- version tag on right bottom

### Changed
- changelog

## v3.3.2 (2016-04-21)
### Changed
- the sale histories order on customer profile now ordered by order date (DESC)

## v3.3.1 (2016-04-21)
### Added
- nprogress to sale reports index
- order history on customer profile

### Changed
- sale reports order now by the transfer date
- style improvement on create new sale form

### Merged
- fetch sroutier@31e1e3833bc88aee3ed2e68935e114c94c525082

## v3.2.2 (2016-04-19)
### Removed
- the disabled columns on create new sale

### Fixed
- bug on sale store because the disabled columns

## v3.2.1 (2016-04-19)
### Added
- customers count on each customer and customer candidate menus
- followups count on each followup customer and customer candidate menu
- edit product now can also edit the supplier column

### Changed
- followup list on customer and customer candidate now is ordered by the created at date
- disaled some column on create new sale

### Fixed
- missing plugins to support layout
- adjust the login page to dynamically match the environment settings

## v3.1.1 (2016-04-18)
### Added
- permissions and roles related to admin auth
- manage followups perm to marketing
- download via excel feature
- search feature ( temporary )

### Changed
- left sidebar ( menu ) to fixed mode

### Fixed
- unusual dot on LC seeder
- missing semicolon on LC seeder

### Removed
- unsigned parameter from string type column in sales table

## v3.0.0
### Changed
- use laravel 5.1 LTS
- use l51esk boilerplate

# OLD VERSION

## v2.0.0
( old version with laravel 4.2 )

## v1.0.0
( old version with cakePHP )

## v0.1.0
- Initial release!! Yeah!
