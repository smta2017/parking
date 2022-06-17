@for ($i=0; $i < 5; $i++) 
 <table dir="rlt">
    <tbody>
        <tr style="margin: 0 0 30px 0 ;">
            <td>{!! QrCode::size(200)->generate($id); !!}</td>
            <td style="vertical-align:top ; ">
                <div style="margin: 0 0 0 30px ;">
                    <h1>ساحة المنتزة</h1>
                    <h3> كود الاشتراك : {{$id}}</h3>
                </div>
            </td>
        </tr>
    </tbody>
    </table>
    <hr>
@endfor