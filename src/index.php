<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Internal VSL CTF 2025</title>
    <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-pacMYjMfOq8Nclm1VVNNrJZqpeO6r3X/Gr+6E0yzN6M4xJj/yxX0hBRV8h62F1M2jS0G2tEXVuP+nX0hbsTlg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="icon" href="assets/images/logo.svg" type="image/png">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
    <audio autoplay loop>
        <source src="assets/sound/playback.mp3" type="audio/mpeg">
        Your browser does not support the audio element.
    </audio>
    <div class="container">
        <!-- Hình Nền Banner -->
        <img src="assets/images/image.png" alt="Banner Internal VSL CTF 2025" class="img-fluid rounded mb-4">

        <h2>Internal VSL CTF 2025</h2>

        <!-- Navigation Tabs -->
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button"
                    role="tab" aria-controls="home" aria-selected="true">Home</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="about-tab" data-bs-toggle="tab" data-bs-target="#about" type="button"
                    role="tab" aria-controls="about" aria-selected="false">About</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="prizes-tab" data-bs-toggle="tab" data-bs-target="#prizes" type="button"
                    role="tab" aria-controls="prizes" aria-selected="false">Prizes</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="roadmap-tab" data-bs-toggle="tab" data-bs-target="#roadmap" type="button"
                    role="tab" aria-controls="roadmap" aria-selected="false">Roadmap</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="dangky-tab" data-bs-toggle="tab" data-bs-target="#dangky" type="button"
                    role="tab" aria-controls="dangky" aria-selected="false">Đăng Ký</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact" type="button"
                    role="tab" aria-controls="contact" aria-selected="false">Contact</button>
            </li>
        </ul>

        <!-- Thông Báo Thành Công hoặc Lỗi -->
        <div id="alert-container"></div>

        <!-- Tab Content -->
        <div class="tab-content" id="myTabContent">
            <!-- Home Tab -->
            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                <div class="home-content">
                    <h3>Chào Mừng Bạn Đến Với Giải Internal VSL CTF 2025</h3>
                    <p>
                        Internal VSL CTF 2025 là cuộc thi lập trình - an toàn thông tin dành cho các sinh viên VKU yêu
                        thích
                        thử thách và khám phá thế giới an ninh mạng. Hãy tham gia ngay cùng chúng mình để rèn luyện kỹ
                        năng, giao
                        lưu và giành những phần quà hấp dẫn!
                    </p>
                    <img src="assets/images/CTF 2025.webp" alt="Home Banner" class="img-fluid">
                </div>
            </div>

            <!-- Đăng Ký Tab -->
            <div class="tab-pane fade" id="dangky" role="tabpanel" aria-labelledby="dangky-tab">
                <!-- Countdown Timer -->
                <div class="countdown-container text-center mb-4">
                    <div class="countdown-title">Thời gian đăng ký còn lại:</div>
                    <div class="countdown d-flex justify-content-center">
                        <div class="me-4">
                            <span id="days">00</span>
                            <div>Ngày</div>
                        </div>
                        <div class="me-4">
                            <span id="hours">00</span>
                            <div>Giờ</div>
                        </div>
                        <div class="me-4">
                            <span id="minutes">00</span>
                            <div>Phút</div>
                        </div>
                        <div>
                            <span id="seconds">00</span>
                            <div>Giây</div>
                        </div>
                    </div>
                </div>

                <form id="registration-form" novalidate>
                    <!-- Registration Options -->
                    <div class="registration-options form-group mb-4">
                        <p><b>Nếu bạn không phải là sinh viên VKU vui lòng gửi email đến vku.sec.lab@gmail.com để được
                                hỗ trợ!</b></p>

                        <label>
                            <input type="radio" name="registration_type" value="team" checked>
                            Tôi có đội
                        </label>
                        <label>
                            <input type="radio" name="registration_type" value="individual">
                            Tôi chưa có đội
                        </label>
                        <label>
                            <input type="radio" name="registration_type" value="external_team">
                            Đăng ký đội khách
                        </label>
                    </div>
                    <!-- Form Đăng Ký Đội Khách -->
                    <div class="external-team-fields" style="display: none;">
                        <div class="form-group mb-4">
                            <label for="external-team-name">Tên Đội <span style="color: red;">*</span></label>
                            <input type="text" id="external-team-name" name="external_team_name" class="form-control"
                                placeholder="Nhập tên đội của bạn" required>
                            <div class="error" id="external-team-name-error">Vui lòng nhập tên đội.</div>
                        </div>

                        <div class="form-group mb-4">
                            <label for="external-school-name">Tên Trường <span style="color: red;">*</span></label>
                            <input type="text" id="external-school-name" name="external_school_name"
                                class="form-control" placeholder="Nhập tên trường của bạn" required>
                            <div class="error" id="external-school-name-error">Vui lòng nhập tên trường.</div>
                        </div>

                        <div class="form-group mb-4">
                            <label for="external-email">Email Liên Hệ <span style="color: red;">*</span></label>
                            <input type="email" id="external-email" name="external_email" class="form-control"
                                placeholder="example@example.com" required>
                            <div class="error" id="external-email-error">Vui lòng nhập email hợp lệ.</div>
                        </div>

                        <div class="form-group mb-4">
                            <label for="external-phone">Số Điện Thoại <span style="color: red;">*</span></label>
                            <input type="tel" id="external-phone" name="external_phone" class="form-control" required
                                placeholder="Nhập số điện thoại liên hệ" pattern="^\+?\d{10,15}$">
                            <div class="error" id="external-phone-error">Vui lòng nhập số điện thoại hợp lệ (10-15 chữ
                                số).</div>
                        </div>
                        <div class="form-group mb-4">
                            <label for="external-members">Số Lượng Thành Viên <span style="color: red;">*</span></label>
                            <select id="external-members" name="external_members" class="form-select" required>
                                <option value="" disabled selected>Chọn số lượng thành viên</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                            </select>
                            <div class="error" id="external-members-error">Vui lòng chọn số lượng thành viên.</div>
                        </div>
                        <div id="external-members-info"></div>
                        <div class="form-group mb-4">
                            <p class="text-muted">
                                <i class="fas fa-info-circle"></i>
                                Sau khi đăng ký, Ban Tổ Chức sẽ nhanh chóng xem xét và xác nhận điều kiện tham gia của
                                đội bạn trong thời gian sớm nhất.
                            </p>
                        </div>
                    </div>
                    <div class="team-fields">
                        <div class="form-group mb-4">
                            <label for="team-name">Tên Đội <span style="color: red;">*</span></label>
                            <input type="text" id="team-name" name="team_name" class="form-control"
                                placeholder="Nhập tên đội của bạn" required>
                            <div class="error" id="team-name-error">Vui lòng nhập tên đội.</div>
                        </div>

                        <div class="form-group mb-4">
                            <label for="email">Email Trường <span style="color: red;">*</span></label>
                            <input type="email" id="email" name="email" class="form-control" required
                                placeholder="example@vku.udn.vn" pattern="^[a-zA-Z0-9._%+-]+@vku\.udn\.vn$">
                            <div class="error" id="email-error">Email phải kết thúc bằng @vku.udn.vn.</div>
                        </div>

                        <div class="form-group mb-4">
                            <label for="phone">Số Điện Thoại <span style="color: red;">*</span></label>
                            <input type="tel" id="phone" name="phone" class="form-control" required
                                placeholder="Nhập số điện thoại liên hệ" pattern="^\+?\d{10,15}$">
                            <div class="error" id="phone-error">Vui lòng nhập số điện thoại hợp lệ (10-15 chữ số).</div>
                        </div>
                        <div class="form-group mb-4">
                            <label for="members">Số Lượng Thành Viên <span style="color: red;">*</span></label>
                            <select id="members" name="members" class="form-select" required>
                                <option value="" disabled selected>Chọn số lượng thành viên</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                            </select>
                            <div class="error" id="members-error">Vui lòng chọn số lượng thành viên.</div>
                        </div>
                        <div id="members-info"></div>
                    </div>
                    <div class="individual-fields">
                        <div class="form-group mb-4">
                            <label for="individual-name">Tên <span style="color: red;">*</span></label>
                            <input type="text" id="individual-name" name="individual_name" class="form-control"
                                placeholder="Nhập tên của bạn" required>
                            <div class="error" id="individual-name-error">Vui lòng nhập tên.</div>
                        </div>
                        <div class="form-group mb-4">
                            <label for="individual-msv">Mã sinh viên <span style="color: red;">*</span></label>
                            <input type="text" id="individual-msv" name="individual_msv" class="form-control"
                                placeholder="Nhập Mã sinh viên của bạn" required>
                            <div class="error" id="individual-msv-error">Vui lòng nhập mã sinh viên.</div>
                        </div>
                        <div class="form-group mb-4">
                            <label for="individual-email">Email <span style="color: red;">*</span></label>
                            <input type="email" id="individual-email" name="individual_email" class="form-control"
                                required placeholder="example@vku.udn.vn" pattern="^[a-zA-Z0-9._%+-]+@vku\.udn\.vn$">
                            <div class="error" id="individual-email-error">Email phải kết thúc bằng @vku.udn.vn.</div>
                        </div>

                        <div class="form-group mb-4">
                            <label for="individual-phone">Số Điện Thoại <span style="color: red;">*</span></label>
                            <input type="tel" id="individual-phone" name="individual_phone" class="form-control"
                                required placeholder="Nhập số điện thoại liên hệ" pattern="^\+?\d{10,15}$">
                            <div class="error" id="individual-phone-error">Vui lòng nhập số điện thoại hợp lệ (10-15 chữ
                                số).</div>
                        </div>

                        <div class="form-group mb-4">
                            <label for="individual-faculty">Khoa <span style="color: red;">*</span></label>
                            <select id="individual-faculty" name="individual_faculty" class="form-select" required>
                                <option value="" disabled selected>Chọn Khoa</option>
                                <option value="Khoa Khoa học máy tính">Khoa Khoa học máy tính</option>
                                <option value="Khoa Kỹ thuật máy tính và Điện tử">Khoa Kỹ thuật máy tính và Điện tử
                                </option>
                                <option value="Khoa Kinh tế số và Thương mại điện tử">Khoa Kinh tế số và Thương mại điện
                                    tử</option>
                                <option value="Khác">Khác</option>
                            </select>
                            <div class="error" id="individual-faculty-error">Vui lòng chọn khoa.</div>
                        </div>
                        <div class="form-group mb-4">
                            <p class="text-muted">
                                <i class="fas fa-info-circle"></i>
                                Nếu bạn chưa có đội, BTC sẽ tiến hành ghép đội cho bạn. Vui lòng điền thông tin cá nhân
                                đầy đủ để chúng tôi hỗ trợ tốt nhất.
                            </p>
                        </div>
                    </div>


                    <button type="submit" class="submit-btn w-100 mt-3">Đăng Ký</button>
                </form>
            </div>

            <!-- Roadmap Tab -->
            <div class="tab-pane fade" id="roadmap" role="tabpanel" aria-labelledby="roadmap-tab">
                <div class="roadmap">
                    <h2>Roadmap</h2>
                    <p>
                        Các mốc thời gian quan trọng của cuộc thi CTF Internal VSL 2025 được liệt kê dưới đây: <br>(Đây là
                        các mốc thời gian dự kiến, có thể thay đổi tùy theo tình hình thực tế)
                    </p>
                    <div class="timeline" id="timeline">
                        <!-- Roadmap Items sẽ được sinh bằng JavaScript -->
                    </div>
                </div>
            </div>

            <!-- About Tab -->
            <div class="tab-pane fade" id="about" role="tabpanel" aria-labelledby="about-tab">
                <div class="about-content">
                    <h3>Giới Thiệu Về CTF</h3>
                    <p>
                        <b>Cuộc thi CTF (Capture The Flag) Internal VSL CTF 2025</b> là sự kiện dành cho các sinh viên
                        yêu thích lĩnh vực an ninh mạng và lập trình, với mục tiêu khuyến khích học hỏi, rèn luyện kỹ
                        năng giải quyết vấn đề và hợp tác trong việc vượt qua các thử thách. Được tổ chức bởi VKU
                        Security Lab (VSL), câu lạc bộ an toàn thông tin của trường Đại học Công nghệ - Thông tin và
                        Truyền thông Việt - Hàn (VKU), cuộc thi tạo cơ hội cho sinh viên trao đổi kiến thức, chia sẻ
                        kinh nghiệm thực tiễn và kết nối cộng đồng lập trình viên, an ninh mạng trong trường.
                    </p>
                    <p>
                        <b>Hình thức tổ chức: </b>Cuộc thi được tổ chức theo hình thức thi trực tiếp theo đội tại trường
                        Đại học Công nghệ - Thông tin và Truyền thông Việt - Hàn (VKU). Các đội thi sẽ cùng nhau giải
                        quyết các thử thách trong thời gian giới hạn và nhận giải thưởng hấp dẫn từ BTC.
                        <br>
                        Có hai hình thức để tham gia:
                    <ul>
                        <li><b>Đăng ký theo đội:</b> Bao gồm tối đa 4 thành viên</li>
                        <li><b>Đăng ký cá nhân:</b> Nếu người đăng ký chưa có đội, btc sẽ xem xét và sắp xếp các bạn vào
                            team phù hợp nếu người đăng ký có nhu cầu</li>
                    </ul>
                    </p>
                    <p>
                        <b>Thời gian tổ chức: </b>Thời gian dự kiến trong 1 ngày, từ 8:00 sáng ngày 04/01/2025 đến 16:00
                        chiều cùng ngày.
                    </p>
                    <p>
                        <b>Hình thức thi: </b>Jeopardy - Giải quyết các thử thách trên nhiều lĩnh vực an ninh mạng và
                        lập trình.
                    </p>
                    <p>
                        <b>Đối tượng tham gia: </b>
                    <ul>
                        <li>Sinh viên VKU yêu thích lĩnh vực an ninh mạng và lập trình</li>
                        <li>Các đội khách mời</li>
                    </ul>
                    </p>
                    <p>
                        Tham gia CTF, bạn sẽ được trải nghiệm các thử thách đa dạng như (Dự kiến):
                    <ul>
                        <li>Kỹ năng lập trình - Lập trình thi đấu</li>
                        <li>Khai thác lỗ hổng Web</li>
                        <li>Dịch ngược mã nguồn</li>
                        <li>Phân tích mã độc</li>
                        <li>Giải mã các mã hóa</li>
                        <li>Điều tra số</li>
                        <li>Khai thác lỗ hổng ứng dụng</li>
                        <li>Kỹ năng tìm kiếm thông tin</li>
                        <li>Và còn nhiều hơn nữa ...</li>
                    </ul>
                    </p>
                    <p>
                        <b>Thời hạn đăng ký: </b>Thời hạn đăng ký từ 20:00 ngày 16/12/2024 đến 21:00 ngày 31/12/2024.
                    </p>
                </div>
            </div>
            <!-- Prizes Tab -->
            <div class="tab-pane fade" id="prizes" role="tabpanel" aria-labelledby="prizes-tab">
                <div class="prizes-content">
                    <h3>Giải Thưởng</h3>
                    <ul class="prizes-list">
                        <li><i class="fas fa-trophy"></i>🥇 Giải Nhất: <b>1,000,000 VND và kỷ niệm chương</b></li>
                        <li><i class="fas fa-medal"></i>🥈 Giải Nhì: <b>600,000 VND và kỷ niệm chương</b></li>
                        <li><i class="fas fa-award"></i>🥉 Giải Ba: <b>300,000 VND và kỷ niệm chương</b></li>
                        <li><i class="fas fa-star"></i>⭐ Giải khuyến khích: <b>100,000 VND</b></li>
                        <li><i class="fas fa-star"></i>🎁 Giải thưởng khác: <b>(First blood, Writeup hay nhất, Đang bổ sung...)</b></li>

                    </ul>
                    <p>
                        Ngoài ra, tất cả các đội tham gia đều sẽ nhận được cơ hội tham gia các khóa học trực tuyến về an
                        ninh mạng cũng như các phần quà hấp dẫn khác từ BTC.
                    </p>
                </div>
            </div>

            <!-- Contact Tab -->
            <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                <div class="contact-content">
                    <h3>Liên Hệ</h3>
                    <form id="contact-form" novalidate>
                        <!-- Description -->
                        <div class="form-group mb-4">
                            <p>
                                Nếu bạn có bất kỳ câu hỏi hoặc góp ý nào, vui lòng điền vào biểu mẫu dưới đây. Chúng tôi
                                sẽ phản hồi
                                lại cho bạn trong thời gian sớm nhất.
                            </p>
                        </div>
                        <div class="form-group mb-4">
                            <label for="contact-name">Tên <span style="color: red;">*</span></label>
                            <input type="text" id="contact-name" name="name" class="form-control" required
                                placeholder="Nhập tên của bạn">
                            <div class="error" id="contact-name-error">Vui lòng nhập tên.</div>
                        </div>
                        <div class="form-group mb-4">
                            <label for="contact-email">Email <span style="color: red;">*</span></label>
                            <input type="email" id="contact-email" name="email" class="form-control" required
                                placeholder="example@vku.udn.vn" pattern="^[a-zA-Z0-9._%+-]+@vku\.udn\.vn$">
                            <div class="error" id="contact-email-error">Email phải kết thúc bằng @vku.udn.vn.</div>
                        </div>
                        <div class="form-group mb-4">
                            <label for="contact-message">Tin Nhắn <span style="color: red;">*</span></label>
                            <textarea id="contact-message" name="message" class="form-control" rows="5" required
                                placeholder="Nhập tin nhắn của bạn"></textarea>
                            <div class="error" id="contact-message-error">Vui lòng nhập tin nhắn.</div>
                        </div>
                        <button type="submit" class="submit-btn w-100 mt-3">Gửi Liên Hệ</button>
                    </form>
                </div>
            </div>
        </div>
        <footer class="text-center mt-5">
            <p>&copy; 2024 - VKU Security Lab</p>
            <!-- Email -->
            <p>
                <i class="fas fa-envelope"></i>
                <a href="mailto:vsl@vku.udn.vn">
                    vsl@vku.udn.vn
                </a>
            </p>
        </footer>
    </div>
    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/main.js"></script>
</body>

</html>