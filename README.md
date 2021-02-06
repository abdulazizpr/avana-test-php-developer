# Getting Started

● Start the test in your local env

● Complete the Test 1 in folder test1

● Complete the Test 2 in folder test2

● Create public repository for this test, and send us your repository link

# Test 1

Write a function as follows:

● The function takes 2 arguments, a string and an integer

● Assume that the integer correctly indicates the index position of an open parenthesis &quot;(&quot; inside the given string

● The function should return an integer, that indicates the index position of the correct corresponding close parent &quot;)&quot; inside the string taking into account nested parenthesized values

You can write the function in PHP.

# Example

If the function receives &quot;a (b c (d e (f) g) h) i (j k)&quot; and 2 as arguments.

nameYourFunction(&quot;a (b c (d e (f) g) h) i (j k)&quot;, 2); // 2 here indicates the &quot;(&quot; right before &quot;b&quot;

The function should return the index position of the &quot;)&quot; right after &quot;h&quot;, in this case, the return value is 20.

# Test 2

Write a psr-4 package to validate excel file format and its data. For this test, you will have to validate two types of excel file Type\_A and Type\_B.

## General Rules

1. Column name that starts with # should not contain any space

2. Column name that ends with \* is a required column, means it must have a value 3. For each file type, it should validate the header columns name and the amount of columns it has:

For example, Type\_A file should only contains 5 columns and the header column name should be and follows the following order;

- Field\_A\*

- #Field\_B

- Field\_C

- Field\_D\*

- Field\_E\*

4. The package should be able to validate both .xls and .xlsx file

5. You may use third party library to parse the excel file

Two sample file is provided namely Type\_A.xlsx and Type\_B.xlsx.

## Sample Output when validating Type\_A.xlsx

| Row | Error |
| --- | --- |
| 3 | Missing value in Field\_A, Field\_B should not contain any space, Missing value in Field\_D |
| 4 | Missing value in Field\_A,Missing value in Field\_E |

## Sample Output when validating Type\_B.xlsx

| Row | Error |
| --- | --- |
| 3 | Missing value in Field\_A, Field\_B should not contain any space |

# Bonus

It will be nice if new file type(Type\_C) can be integrated by just adding Type\_C.php

## Coding Recommendation

1. Follow DRY principle

2. Write simple but meaningful code

3. Incorporate design patterns in your code

## Sources

● Type\_A.xlsx

● Type\_B.xlsx

### Enjoy your test!