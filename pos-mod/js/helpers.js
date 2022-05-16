export default function formatNumber(value) {
  const toFormat = value.toFixed(2);
  console.log(toFormat);
  return new Intl.NumberFormat('en-US', {
    style: 'decimal',
    minimumFractionDigits: 2,
  }).format(toFormat);
}
