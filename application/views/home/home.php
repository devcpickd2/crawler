    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <div class="container">
        <h1 class="mt-5 mb-3">Data Suhu Ruangan</h1>
        <canvas id="suhuChart" width="800" height="400"></canvas>
        <div class="table-responsive mt-5">
            <table class="table table-bordered">
                <thead class="table-secondary">
                    <tr>
                        <th>Tanggal</th>
                        <th>Shift</th>
                        <th>Pukul</th>
                        <th>Chill Room</th>
                        <th>Anteroom</th>
                        <th>Cold Storage 2</th>
                        <th>Seasoning T</th>
                        <th>Seasoning RH</th>
                        <th>Prep. Room</th>
                        <th>Filling Room</th>
                        <th>rice Room</th>
                        <th>noodle Room</th>
                        <th>topping area</th>
                        <th>packing_karton</th>
                        <th>dry_T</th>
                        <th>dry_RH</th>
                        <th>cold_fg</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($suhu_ruangan as $data): ?>
                    <tr>
                        <td><?php echo $data->date; ?></td>
                        <td><?php echo $data->shift; ?></td>
                        <td><?php echo $data->pukul; ?></td>
                        <td><?php echo $data->chill_room; ?></td>
                        <td><?php echo $data->cold_stor1; ?></td>
                        <td><?php echo $data->cold_stor2; ?></td>
                        <td><?php echo $data->anteroom; ?></td>
                        <td><?php echo $data->sea_T; ?></td>
                        <td><?php echo $data->prep_room; ?></td>
                        <td><?php echo $data->cooking_room; ?></td>
                        <td><?php echo $data->filling_room; ?></td>
                        <td><?php echo $data->rice_room; ?></td>
                        <td><?php echo $data->noodle_room; ?></td>
                        <td><?php echo $data->topping_area; ?></td>
                        <td><?php echo $data->packing_karton; ?></td>
                        <td><?php echo $data->dry_T; ?></td>
                        <td><?php echo $data->dry_RH; ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    <script>
        var suhuRuanganData = <?php echo json_encode($suhu_ruangan); ?>;

        var tanggal = [];
        var suhuChillRoom = [];
        var suhuColdStor1 = [];
        var suhuColdStor2 = [];
        var suhuAnteroom = [];
        var suhuSeaT = [];
        var suhuSeaRH = [];
        var suhuPrepRoom = [];
        var suhuCookingRoom = [];
        var suhuFillingRoom = [];
        var suhuRiceRoom = [];
        var suhuNoodleRoom = [];
        var suhuToppingArea = [];
        var suhuPackingKarton = [];
        var suhuDryT = [];
        var suhuDryRH = [];
        var suhuColdFg = [];
        suhuRuanganData.forEach(function(item) {
            tanggal.push(item.date);
            suhuChillRoom.push(item.chill_room);
            suhuColdStor1.push(item.cold_stor1);
            suhuColdStor2.push(item.cold_stor2);
            suhuAnteroom.push(item.anteroom);
            suhuSeaT.push(item.sea_T);
            suhuSeaRH.push(item.sea_RH);
            suhuPrepRoom.push(item.prep_room);
            suhuCookingRoom.push(item.cooking_room);
            suhuFillingRoom.push(item.filling_room);
            suhuRiceRoom.push(item.rice_room);
            suhuNoodleRoom.push(item.noodle_room);
            suhuToppingArea.push(item.topping_area);
            suhuPackingKarton.push(item.packing_karton);
            suhuDryT.push(item.dry_T);
            suhuDryRH.push(item.dry_RH);
            suhuColdFg.push(item.cold_fg);
        });

        var ctx = document.getElementById('suhuChart').getContext('2d');
        var suhuChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: tanggal, 
                datasets: [{
                    label: 'Suhu Chill Room',
                    data: suhuChillRoom,
                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                    borderColor: 'rgba(255, 99, 132, 1)',
                    borderWidth: 1
                },{
                    label: 'Cold Storage 1',
                    data: suhuColdStor1,
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                },{
                    label: 'Cold Storage 2',
                    data: suhuColdStor2,
                    backgroundColor: 'rgba(255, 206, 86, 0.2)',
                    borderColor: 'rgba(255, 206, 86, 1)',
                    borderWidth: 1
                },{
                    label: 'Anteroom',
                    data: suhuAnteroom,
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                },{
                    label: 'Seasoning T',
                    data: suhuSeaT,
                    backgroundColor: 'rgba(153, 102, 255, 0.2)',
                    borderColor: 'rgba(153, 102, 255, 1)',
                    borderWidth: 1
                },{
                    label: 'Seasoning RH',
                    data: suhuSeaRH,
                    backgroundColor: 'rgba(255, 159, 64, 0.2)',
                    borderColor: 'rgba(255, 159, 64, 1)',
                    borderWidth: 1
                },{
                    label: 'Prep. Room',
                    data: suhuPrepRoom,
                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                    borderColor: 'rgba(255, 99, 132, 1)',
                    borderWidth: 1
                },{
                    label: 'Cooking Room',
                    data: suhuCookingRoom,
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                },{
                    label: 'Filling Room',
                    data: suhuFillingRoom,
                    backgroundColor: 'rgba(255, 206, 86, 0.2)',
                    borderColor: 'rgba(255, 206, 86, 1)',
                    borderWidth: 1
                },{
                    label: 'Rice Room',
                    data: suhuRiceRoom,
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                },{
                    label: 'Noodle Room',
                    data: suhuNoodleRoom,
                    backgroundColor: 'rgba(153, 102, 255, 0.2)',
                    borderColor: 'rgba(153, 102, 255, 1)',
                    borderWidth: 1
                },{
                    label: 'Topping Area',
                    data: suhuToppingArea,
                    backgroundColor: 'rgba(255, 159, 64, 0.2)',
                    borderColor: 'rgba(255, 159, 64, 1)',
                    borderWidth: 1
                },{
                    label: 'Packing Karton',
                    data: suhuPackingKarton,
                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                    borderColor: 'rgba(255, 99, 132, 1)',
                    borderWidth: 1
                },{
                    label: 'Dry T',
                    data: suhuDryT,
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                },{
                    label: 'Dry RH',
                    data: suhuDryRH,
                    backgroundColor: 'rgba(255, 206, 86, 0.2)',
                    borderColor: 'rgba(255, 206, 86, 1)',
                    borderWidth: 1
                },{
                    label: 'Cold FG',
                    data: suhuColdFg,
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: false
                        }
                    }]
                }
            }
        });
    </script>