# Evflow Benchmarks
A collection of benchmarks and testing scripts for Evflow and asynchronous code
techniques in general.

## Usage
Benchmarks are measured using [Athletic](https://github.com/polyfractal/athletic).
You can run all benchmarks using the `./runall` script.

## Current observations
Below are some current results for some of the benchmarks in this package.

### Evflow\Benchmarks\SelectEvent
| Method Name          | Iterations | Average Time    | Ops/second   |
| -------------------- | ---------- | --------------- | ------------ |
| singleReadSelect     | 10,000     | 0.0000247820854 | 40,351.72921 |
| multipleReadSelects  | 10,000     | 0.0001822679043 | 5,486.42946  |
| singleWriteSelect    | 10,000     | 0.0000205159903 | 48,742.46807 |
| multipleWriteSelects | 10,000     | 0.0001852510452 | 5,398.08020  |
