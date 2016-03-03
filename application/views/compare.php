
<table>
    <thead>
        <tr>
            <th class="data"><?=$data1[0]->model?></th>
            <th class="option">옵션</th>
            <th class="data"><?=$data2[0]->model?></th>
        </tr>
    </thead>
    
    <tbody>
        <tr>
            <td><img src="<?=$data1[0]->img_url?>" class="compare_thumbs"></td>
            <td class="option"><strong></strong></td>
            <td><img src="<?=$data2[0]->img_url?>" class="compare_thumbs"></td>
        </tr>
        <tr>
            <td class="data"><?=$data1[0]->lcd_size?></td>
            <td class="option"><strong>화면 크기</strong></td>
            <td class="data"><?=$data2[0]->lcd_size?></td>
        </tr>
        <tr>
            <td class="data"><?=$data1[0]->lcd_resolution?></td>
            <td class="option"><strong>해상도</strong></td>
            <td class="data"><?=$data2[0]->lcd_resolution?></td>
        </tr>
    </tbody>
</table>
<table>
    <tbody>
        <tr>
            <td class="data"><?=$data1[0]->cpu_core?></td>
            <td class="option"><strong>CPU</strong></td>
            <td class="data"><?=$data2[0]->cpu_core?></td>
        </tr>
        <tr>
            <td class="data"><?=$data1[0]->cpu_clock?></td>
            <td class="option"><strong>CPU 클럭</strong></td>
            <td class="data"><?=$data2[0]->cpu_clock?></td>
        </tr>
    </tbody>
</table>
<table>
    <tbody>
        <tr>
            <td class="data"><?=$data1[0]->memory_size?></td>
            <td class="option"><strong>RAM</strong></td>
            <td class="data"><?=$data2[0]->memory_size?></td>
        </tr>
        <tr>
            <td class="data"><?=$data1[0]->memory_spec?></td>
            <td class="option"><strong>RAM 종류</strong></td>
            <td class="data"><?=$data2[0]->memory_spec?></td>
        </tr>
    </body>
</table>
<table>
    <tbody>
        <tr>
            <td class="data"><?=$data1[0]->graphic_spec?></td>
            <td class="option"><strong>GPU 종류</strong></td>
            <td class="data"><?=$data2[0]->graphic_spec?></td>
        </tr>
        <tr>
            <td class="data"><?=$data1[0]->graphic_chip?></td>
            <td class="option"><strong>GPU 모델</strong></td>
            <td class="data"><?=$data2[0]->graphic_chip?></td>
        </tr>
        <tr>
            <td class="data"><?=$data1[0]->graphic_mem?></td>
            <td class="option"><strong>GPU 전용 메모리</strong></td>
            <td class="data"><?=$data2[0]->graphic_mem?></td>
        </tr>
    </tbody>
</table>