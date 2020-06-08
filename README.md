# 2dArray

/**Author: Bill Yang
5 24 2020
This program is to implement a state machine diagram for a online tutoring website, more details please check courseDeckFlow.pdf.
The input file is stateMachine.csv, format likes 1>0>2 or 1>1>4, the three integers respectively means the cur_state, check conditions and next_state.
Some codes from "A simple function to return 2 Dimensional array by parsing a CSV file" of https://www.php.net/manual/en/function.fgetcsv.php：

fgetcsv ( resource $handle [, int $length = 0 [, string $delimiter = ">" [, string $enclosure = '"' [, string $escape = "\\" ]]]] ) : array
 * another way to express parameters, [, string $delimiter = ">"], belong to not

https://raw.githubusercontent.com/ishaberry/Covid19Canada/master/timeseries_prov/cases_timeseries_prov.csv
https://www.php.net/manual/en/function.str-getcsv.php
https://www.php.net/manual/en/function.count.php
 */
