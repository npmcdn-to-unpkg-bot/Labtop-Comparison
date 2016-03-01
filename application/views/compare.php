<table>
    <thead>
        <tr>
            <th>Data1</th>
            <th>option</th>
            <th>Data2</th>
        </tr>
    </thead>
    
    <tbody>
        <tr>
            <td>
                <?=$data1[0]->model?></td>
            <td><strong>모델명</strong></td>
            <td>
                <?=$data2[0]->model?></td>
        </tr>
        <tr>
            <td>
                <?=$data1[0]->cpu_clock?></td>
            <td><strong>CPU 클럭</strong></td>
            <td>
                <?=$data2[0]->cpu_clock?></td>
        </tr>
    </tbody>
</table>