// جلب البيانات من ملف PHP
fetch('fetch_data.php') // تأكد أن مسار ملف PHP صحيح
  .then(response => response.json())
  .then(data => {
    const ctx = document.getElementById('doughnut');

    new Chart(ctx, {
      type: 'doughnut',
      data: {
        labels: data.branches, // أسماء الفروع مع المواقع
        datasets: [{
          label: 'Total Profit',
          data: data.profits, // مجموع الأرباح لكل فرع
          backgroundColor: [
            '#c64c20', '#d78162', '#e2a58f', '#e8b7a5', '#edc9bc', '#f3dbd2', '#f9ede8'
          ],
          borderWidth: 1
        }]
      },
      options: {
        plugins: {
          legend: {
            position: 'top', // موقع أسطورة البيانات
          },
          tooltip: {
            callbacks: {
              label: function (tooltipItem) {
                // عرض اسم الفرع مع الموقع وصافي الربح
                return `${data.branches[tooltipItem.dataIndex]}: ${data.profits[tooltipItem.dataIndex]} JD`;
              },
            },
          },
        },
      },
    });
  })
  .catch(error => console.error('Error fetching data:', error));
