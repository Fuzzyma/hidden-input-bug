# Project to show the bug when testing commands using hiddeninput.exe

## Reproduce issue:

```bash
git clone https://github.com/Fuzzyma/hidden-input-bug
cd hidden-input-bug
composer install
// run command which works:
bin/console testbed:hidden
// phpunit just does nothing and waits for input:
phpunit
```