.PHONY: check pint pint-check larastan

check: pint-check larastan

pint-check:
	./vendor/bin/pint --test

larastan:
	./vendor/bin/phpstan analyse

pint:
	./vendor/bin/pint
