.PHONY: check fix pint-check larastan

check: pint-check larastan

pint-check:
	./vendor/bin/pint --test

larastan:
	./vendor/bin/phpstan analyse

fix:
	./vendor/bin/pint
