<div style="margin:0px auto;width:600px">
    <div style="padding:0px 20px">
        <table align="center" bgcolor="#dcf0f8" border="0" cellpadding="0" cellspacing="0"
            style="margin:0;padding:0;background-color:#ffffff;width:100%!important;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px"
            width="100%">
            <tbody>
                <tr>
                    <td>
                        <h1 style="font-size:17px;font-weight:bold;color:#444;padding:0 0 5px 0;margin:0">Cảm ơn quý
                            khách {{ $customer->name }} đã đặt hàng tại ISMART</h1>

                        <p
                            style="margin:4px 0;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal">
                            ISMART rất vui thông báo đơn hàng #DH_{{ $order->id }} của quý khách đã được tiếp nhận
                            và đang trong quá trình xử lý. ISMART sẽ thông báo đến quý khách ngay khi hàng chuẩn bị được
                            giao.</p>

                        <h3
                            style="font-size:13px;font-weight:bold;color:#02acea;text-transform:uppercase;margin:20px 0 0 0;border-bottom:1px solid #ddd">
                            Thông tin đơn hàng #DH{{ $order->id }} <span
                                style="font-size:12px;color:#777;text-transform:none;font-weight:normal"></span></h3>
                    </td>
                </tr>
                <tr>
                    <td style="font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px">
                        <table border="0" cellpadding="0" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th align="left"
                                        style="padding:6px 9px 0px 9px;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;font-weight:bold"
                                        width="50%">Thông tin thanh toán</th>
                                    <th align="left"
                                        style="padding:6px 9px 0px 9px;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;font-weight:bold"
                                        width="50%"> Địa chỉ giao hàng </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td style="padding:3px 9px 9px 9px;border-top:0;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal"
                                        valign="top"><span
                                            style="text-transform:capitalize">{{ $customer->name }}</span><br>
                                        <a href="mailto:phancuong.qt@gmail.com"
                                            target="_blank">{{ $customer->name }}</a><br>
                                        {{ $customer->phone }}
                                    </td>
                                    <td style="padding:3px 9px 9px 9px;border-top:0;border-left:0;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal"
                                        valign="top"><span
                                            style="text-transform:capitalize">{{ $customer->name }}</span><br>
                                        <a href="mailto:phancuong.qt@gmail.com"
                                            target="_blank">{{ $customer->email }}</a>
                                            <br>{{ $customer->address }}, Tỉnh {{$customer->province->name}}, {{$customer->district->name}}, {{$customer->wards->name}}<br>
                                        SĐT: {{ $customer->phone }}
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="2"
                                        style="padding:7px 9px 0px 9px;border-top:0;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444"
                                        valign="top">
                                        <p
                                            style="font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal">
                                            <strong>Phương thức thanh toán: </strong> Thanh toán tiền mặt khi nhận
                                            hàng<br>
                                            <strong>Thời gian giao hàng dự kiến:</strong> 3 ngày <br>
                                            <strong>Phí vận chuyển: </strong> 0đ<br>
                                            {{-- <strong>Sử dụng bọc sách cao cấp Bookcare: </strong>  Không <br> --}}
                                        </p>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td>
                        <p
                            style="margin:4px 0;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal">
                            <i>Lưu ý: Đối với đơn hàng đã được thanh toán trước, nhân viên giao nhận có thể yêu cầu
                                người nhận hàng cung cấp CMND / giấy phép lái xe để chụp ảnh hoặc ghi lại thông tin.</i>
                        </p>
                    </td>
                </tr>
                <tr>
                    <td>
                        <h2
                            style="text-align:left;margin:10px 0;border-bottom:1px solid #ddd;padding-bottom:5px;font-size:13px;color:#02acea">
                            CHI TIẾT ĐƠN HÀNG</h2>

                        <table border="0" cellpadding="0" cellspacing="0" style="background:#f5f5f5" width="100%">
                            <thead>
                                <tr>
                                    <th align="left" bgcolor="#02acea"
                                        style="padding:6px 9px;color:#fff;font-family:Arial,Helvetica,sans-serif;font-size:12px;line-height:14px">
                                        Sản phẩm</th>
                                    <th align="left" bgcolor="#02acea"
                                        style="padding:6px 9px;color:#fff;font-family:Arial,Helvetica,sans-serif;font-size:12px;line-height:14px">
                                        Đơn giá</th>
                                    <th align="left" bgcolor="#02acea"
                                        style="padding:6px 9px;color:#fff;font-family:Arial,Helvetica,sans-serif;font-size:12px;line-height:14px">
                                        Số lượng</th>
                                    {{-- <th align="left" bgcolor="#02acea"
                                        style="padding:6px 9px;color:#fff;font-family:Arial,Helvetica,sans-serif;font-size:12px;line-height:14px">
                                        Giảm giá</th> --}}
                                    <th align="right" bgcolor="#02acea"
                                        style="padding:6px 9px;color:#fff;font-family:Arial,Helvetica,sans-serif;font-size:12px;line-height:14px">
                                        Tổng tạm</th>
                                </tr>
                            </thead>
                            @foreach ($cart as $row)
                            <tbody bgcolor="#eee"
                                style="font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px">
                                <tr>
                                    <td align="left" style="padding:3px 9px" valign="top">
                                        <span>
                                            {{$row->name}}
                                        </span><br>
                                    </td>
                                    <td align="left" style="padding:3px 9px" valign="top"><span>{{number_format($row->price, 0, ',','.')}}đ</span></td>
                                    <td align="left" style="padding:3px 9px" valign="top">{{$row->qty}}</td>
                                    {{-- <td align="left" style="padding:3px 9px" valign="top"><span>0đ</span></td> --}}
                                    <td align="right" style="padding:3px 9px" valign="top"><span>{{number_format($row->total, 0, ',','.')}}đ</span></td>
                                </tr>

                            </tbody>

                            @endforeach

                            <tfoot
                                style="font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px">
                                <tr>
                                    <td align="right" colspan="3" style="padding:5px 9px">Tạm tính</td>
                                    <td align="right" style="padding:5px 9px"><span>{{number_format($order->total, 0, ',','.')}}</span></td>
                                </tr>
                                <tr>
                                    <td align="right" colspan="3" style="padding:5px 9px">Phí vận chuyển</td>
                                    <td align="right" style="padding:5px 9px"><span>0đ</span></td>
                                </tr>

                                <tr bgcolor="#eee">
                                    <td align="right" colspan="3" style="padding:7px 9px"><strong><big>Tổng giá
                                                trị đơn hàng</big> </strong></td>
                                    <td align="right" style="padding:7px 9px"><strong><big><span>{{number_format($order->total, 0, ',','.')}}đ</span>
                                            </big> </strong></td>
                                </tr>
                                {{-- <tr bgcolor="#eee">
                                    <td align="right" colspan="4" style="padding:7px 9px"><strong><big>Thưởng
                                                Astra</big> </strong></td>
                                    <td align="right" style="padding:7px 9px"><strong><big><span>0.86</span> </big>
                                        </strong></td>
                                </tr> --}}

                            </tfoot>
                        </table>

                        <div style="margin:auto"><a
                                href="https://x64km.mjt.lu/lnk/CAAAA7vceCAAAAAKFZgAAAK_biwAAAAA3NwAAAAAABPsQgBj1J_dqt2vz__3SrehsqtTtExN6gAPBhU/5/-FHOx_cNuysNkF5ymlQCNg/aHR0cHM6Ly90aWtpLnZuL3NhbGVzL29yZGVyL3ZpZXcvMzI3NTM4NjY2"
                                style="display:inline-block;text-decoration:none;background-color:#00b7f1!important;margin-right:30px;text-align:center;border-radius:3px;color:#fff;padding:5px 10px;font-size:12px;font-weight:bold;margin-left:35%;margin-top:5px"
                                target="_blank"
                                data-saferedirecturl="https://www.google.com/url?q=https://x64km.mjt.lu/lnk/CAAAA7vceCAAAAAKFZgAAAK_biwAAAAA3NwAAAAAABPsQgBj1J_dqt2vz__3SrehsqtTtExN6gAPBhU/5/-FHOx_cNuysNkF5ymlQCNg/aHR0cHM6Ly90aWtpLnZuL3NhbGVzL29yZGVyL3ZpZXcvMzI3NTM4NjY2&amp;source=gmail&amp;ust=1675257436642000&amp;usg=AOvVaw057UBwG26f1cQg0sGiKgUf">Chi
                                tiết đơn hàng tại ISMART</a></div>
                    </td>
                </tr>
                <tr>
                    <td>&nbsp;
                        <a href="https://x64km.mjt.lu/lnk/CAAAA7vceCAAAAAKFZgAAAK_biwAAAAA3NwAAAAAABPsQgBj1J_dqt2vz__3SrehsqtTtExN6gAPBhU/6/Re324MYvK9nNTJ7nx_ClRw/aHR0cHM6Ly90aWtpLnZuL3NlcC9ob21l"
                            target="_blank"
                            data-saferedirecturl="https://www.google.com/url?q=https://x64km.mjt.lu/lnk/CAAAA7vceCAAAAAKFZgAAAK_biwAAAAA3NwAAAAAABPsQgBj1J_dqt2vz__3SrehsqtTtExN6gAPBhU/6/Re324MYvK9nNTJ7nx_ClRw/aHR0cHM6Ly90aWtpLnZuL3NlcC9ob21l&amp;source=gmail&amp;ust=1675257436642000&amp;usg=AOvVaw1LqO0xxjv0V1V_pcXP1KXH">
                            <img src="https://ci3.googleusercontent.com/proxy/hzh2_D8PnxbNuz83P2hqu7idL2qy94GqnqYXp-UQ5xdYKBQGrnUeN5AydFuxmzUSieep9ZdwYRsfbt6zuNF1thYiOgnqMceKMfO7i1EpfFAgpfDdRQqefoOXJCePZ4ryZpUX=s0-d-e1-ft#https://salt.tikicdn.com/ts/upload/5e/82/5c/882d4c145fcc70bd1881b84e8684f8cf.png"
                                alt="banner" width="100%" class="CToWUd" data-bit="iit">
                        </a>
                    </td>
                </tr>
                <tr>
                    <td>&nbsp;
                        <p
                            style="margin:0;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal">
                            Trường hợp quý khách có những băn khoăn về đơn hàng, có thể xem thêm mục <a
                                href="https://x64km.mjt.lu/lnk/CAAAA7vceCAAAAAKFZgAAAK_biwAAAAA3NwAAAAAABPsQgBj1J_dqt2vz__3SrehsqtTtExN6gAPBhU/7/XDSuObCy11w4pQVGEXKncQ/aHR0cDovL2hvdHJvLnRpa2kudm4vaGMvdmkvP3V0bV9zb3VyY2U9dHJhbnNhY3Rpb25hbCtlbWFpbCZ1dG1fbWVkaXVtPWVtYWlsJnV0bV90ZXJtPWxvZ28mdXRtX2NhbXBhaWduPW5ldytvcmRlcg"
                                title="Các câu hỏi thường gặp" target="_blank"
                                data-saferedirecturl="https://www.google.com/url?q=https://x64km.mjt.lu/lnk/CAAAA7vceCAAAAAKFZgAAAK_biwAAAAA3NwAAAAAABPsQgBj1J_dqt2vz__3SrehsqtTtExN6gAPBhU/7/XDSuObCy11w4pQVGEXKncQ/aHR0cDovL2hvdHJvLnRpa2kudm4vaGMvdmkvP3V0bV9zb3VyY2U9dHJhbnNhY3Rpb25hbCtlbWFpbCZ1dG1fbWVkaXVtPWVtYWlsJnV0bV90ZXJtPWxvZ28mdXRtX2NhbXBhaWduPW5ldytvcmRlcg&amp;source=gmail&amp;ust=1675257436643000&amp;usg=AOvVaw3fzVfcKJGbgqg1Wo3oRUZU">
                                <strong>các câu hỏi thường gặp</strong>.</a></p>

                        <p
                            style="font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal;border:1px #14ade5 dashed;padding:5px;list-style-type:none">
                            Từ ngày 14/2/2015, ISMART sẽ không gởi tin nhắn SMS khi đơn hàng của bạn được xác nhận thành
                            công. Chúng tôi chỉ liên hệ trong trường hợp đơn hàng có thể bị trễ hoặc không liên hệ giao
                            hàng được.</p>

                        <p
                            style="margin:10px 0 0 0;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal">
                            Mọi thắc mắc và góp ý, quý khách vui lòng liên hệ với ISMART Care qua <a
                                href="https://x64km.mjt.lu/lnk/CAAAA7vceCAAAAAKFZgAAAK_biwAAAAA3NwAAAAAABPsQgBj1J_dqt2vz__3SrehsqtTtExN6gAPBhU/8/8ubcAz7zNgwoFErAJfeYig/aHR0cHM6Ly9ob3Ryby50aWtpLnZuL2hjL3Zp"
                                target="_blank"
                                data-saferedirecturl="https://www.google.com/url?q=https://x64km.mjt.lu/lnk/CAAAA7vceCAAAAAKFZgAAAK_biwAAAAA3NwAAAAAABPsQgBj1J_dqt2vz__3SrehsqtTtExN6gAPBhU/8/8ubcAz7zNgwoFErAJfeYig/aHR0cHM6Ly9ob3Ryby50aWtpLnZuL2hjL3Zp&amp;source=gmail&amp;ust=1675257436643000&amp;usg=AOvVaw2wZ5hu1ey5JV2ZBsDSeUOd">https://hotro.tiki.vn/hc/vi</a>.
                            Đội ngũ ISMART Care luôn sẵn sàng hỗ trợ bạn.</p>
                    </td>
                </tr>
                <tr>
                    <td>&nbsp;
                        <p>Một lần nữa ISMART cảm ơn quý khách.</p>

                        <p><strong><a
                                    href="https://x64km.mjt.lu/lnk/CAAAA7vceCAAAAAKFZgAAAK_biwAAAAA3NwAAAAAABPsQgBj1J_dqt2vz__3SrehsqtTtExN6gAPBhU/9/EpmrS-pnfO_QbubDqLaPsQ/aHR0cDovL3Rpa2kudm4_dXRtX3NvdXJjZT10cmFuc2FjdGlvbmFsK2VtYWlsJnV0bV9tZWRpdW09ZW1haWwmdXRtX3Rlcm09bG9nbyZ1dG1fY2FtcGFpZ249bmV3K29yZGVy"
                                    style="color:#00a3dd;text-decoration:none;font-size:14px" target="_blank"
                                    data-saferedirecturl="https://www.google.com/url?q=https://x64km.mjt.lu/lnk/CAAAA7vceCAAAAAKFZgAAAK_biwAAAAA3NwAAAAAABPsQgBj1J_dqt2vz__3SrehsqtTtExN6gAPBhU/9/EpmrS-pnfO_QbubDqLaPsQ/aHR0cDovL3Rpa2kudm4_dXRtX3NvdXJjZT10cmFuc2FjdGlvbmFsK2VtYWlsJnV0bV9tZWRpdW09ZW1haWwmdXRtX3Rlcm09bG9nbyZ1dG1fY2FtcGFpZ249bmV3K29yZGVy&amp;source=gmail&amp;ust=1675257436643000&amp;usg=AOvVaw3dEAtKZ8rDcUk_N25BSoT7">ISMART</a>
                            </strong></p>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
