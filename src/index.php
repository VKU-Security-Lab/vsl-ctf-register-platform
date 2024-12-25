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
    <!-- Logo -->
    <link rel="icon" href="assets/images/logo.svg" type="image/png">
    <!-- Custom CSS -->
    <style>
        /* Tổng quát */
        body {
            background: linear-gradient(135deg, #a1c4fd, #c2e9fb);
            font-family: 'Roboto', sans-serif;
            color: #333333;
        }

        .container {
            max-width: 900px;
            margin: 50px auto;
            padding: 40px;
            background: linear-gradient(135deg, #ffffff, #d4e0ff);
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }

        h2 {
            font-weight: 700;
            color: #4b6cb7;
            background: -webkit-linear-gradient(45deg, #4b6cb7, #182848);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            margin-bottom: 30px;
            text-align: center;
            font-size: 2.5rem;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.1);
        }

        /* Navigation Tabs */
        .nav-tabs {
            margin-bottom: 30px;
            border-bottom: none;
            justify-content: center;
        }

        .nav-tabs .nav-link {
            color: #6c757d;
            font-weight: 600;
            border: none;
            border-radius: 10px 10px 0 0;
            padding: 10px 20px;
            background: #f8f9fa;
            margin: 0 5px;
            transition: all 0.3s;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .nav-tabs .nav-link.active {
            color: #ffffff;
            background: #4b6cb7;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
        }

        .nav-tabs .nav-link:hover {
            background: #e0e0e0;
            color: #4b6cb7;
        }

        /* Form Styling */
        .form-group label {
            font-weight: 500;
            color: #555555;
        }

        .form-control {
            border-radius: 10px;
            border: 1px solid #ced4da;
            padding: 12px 20px;
            transition: border-color 0.3s;
            background: #f0f8ff;
        }

        .form-control:focus {
            border-color: #4b6cb7;
            box-shadow: none;
            background: #e0f7fa;
        }

        .submit-btn {
            background: linear-gradient(45deg, #4b6cb7, #182848);
            color: #ffffff;
            border: none;
            padding: 12px 20px;
            border-radius: 10px;
            cursor: pointer;
            font-size: 1rem;
            transition: background 0.3s, transform 0.3s;
        }

        .submit-btn:hover {
            background: linear-gradient(45deg, #182848, #4b6cb7);
            transform: translateY(-3px);
        }

        .error {
            color: #dc3545;
            display: none;
            font-size: 0.875em;
            margin-top: 5px;
        }

        /* Countdown Timer */
        .countdown-container {
            background: linear-gradient(135deg, #a1c4fd, #c2e9fb);
            padding: 25px;
            border-radius: 15px;
            box-shadow: inset 0 0 10px rgba(0, 0, 0, 0.05);
            margin-bottom: 30px;
        }

        .countdown-title {
            font-size: 1.3rem;
            font-weight: 600;
            color: #ff7e5f;
        }

        .countdown {
            display: flex;
            justify-content: center;
            gap: 30px;
            margin-top: 15px;
        }

        .countdown div {
            text-align: center;
        }

        .countdown span {
            display: block;
            font-size: 2.5rem;
            font-weight: 700;
            color: #ff5722;
        }

        /* Roadmap Styling */
        .roadmap {
            margin-top: 30px;
        }

        .roadmap h2 {
            margin-bottom: 30px;
            color: #4b6cb7;
            text-align: center;
            background: -webkit-linear-gradient(45deg, #4b6cb7, #182848);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .timeline {
            position: relative;
            max-width: 800px;
            margin: 0 auto;
            padding: 20px 0;
        }

        .timeline::after {
            content: '';
            position: absolute;
            width: 4px;
            background-color: #4b6cb7;
            top: 0;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
        }

        .timeline-item {
            padding: 20px 40px;
            position: relative;
            background-color: inherit;
            width: 50%;
            transition: all 0.3s;
        }

        .timeline-item.left {
            left: 0;
        }

        .timeline-item.right {
            left: 50%;
        }

        .timeline-item::after {
            content: '';
            position: absolute;
            width: 20px;
            height: 20px;
            right: -10px;
            background-color: #4b6cb7;
            border: 4px solid #ffffff;
            top: 20px;
            border-radius: 50%;
            z-index: 1;
            transition: all 0.3s;
        }

        .timeline-item.right::after {
            left: -10px;
        }

        .timeline-content {
            padding: 20px 30px;
            background-color: #f0f8ff;
            position: relative;
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: all 0.3s;
        }

        .timeline-content h3 {
            margin-bottom: 10px;
            color: #4b6cb7;
            font-size: 1.3rem;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .timeline-content p {
            margin: 0;
            color: #555555;
            font-size: 1rem;
        }

        /* Highlight next event */
        .timeline-item.highlight .timeline-content {
            background-color: #d4edda;
            border-left: 6px solid #28a745;
        }

        .timeline-item.highlight::after {
            background-color: #28a745;
        }

        /* Completed event */
        .timeline-item.completed .timeline-content {
            background-color: #d1ecf1;
            border-left: 6px solid #17a2b8;
        }

        .timeline-item.completed::after {
            background-color: #17a2b8;
        }

        /* Responsive */
        @media screen and (max-width: 768px) {
            .timeline::after {
                left: 20px;
            }

            .timeline-item {
                width: 100%;
                padding-left: 60px;
                padding-right: 25px;
                margin-bottom: 20px;
            }

            .timeline-item.right {
                left: 0%;
            }

            .timeline-item::after {
                left: 10px;
            }
        }

        /* Alert Container */
        #alert-container {
            margin-bottom: 20px;
        }

        /* Member Info Styling */
        .member-info {
            background-color: #e6f7ff;
            border: 1px solid #ced4da;
            border-radius: 15px;
            padding: 25px;
            margin-bottom: 25px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        }

        .member-info h4 {
            margin-bottom: 20px;
            color: #4b6cb7;
        }

        /* Smooth Transition for Tabs */
        .tab-pane {
            animation: fadeIn 0.5s;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Additional Styling for New Pages */
        /* Home Page */
        .home-content {
            text-align: center;
            padding: 20px;
        }

        .home-content p {
            font-size: 1.1rem;
            color: #555555;
        }

        .home-content img {
            max-width: 100%;
            height: auto;
            border-radius: 15px;
            margin-top: 20px;
        }

        /* About Page */
        .about-content {
            padding: 20px;
        }

        .about-content h3 {
            color: #4b6cb7;
            margin-bottom: 15px;
        }

        .about-content p {
            font-size: 1rem;
            color: #555555;
            margin-bottom: 10px;
        }

        /* Prizes Page */
        .prizes-content {
            padding: 20px;
        }

        .prizes-content h3 {
            color: #4b6cb7;
            margin-bottom: 15px;
        }

        .prizes-list {
            list-style: none;
            padding: 0;
        }

        .prizes-list li {
            background: #f0f8ff;
            padding: 15px;
            margin-bottom: 10px;
            border-radius: 10px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .prizes-list li i {
            color: #28a745;
            font-size: 1.5rem;
        }

        /* Contact Page */
        .contact-content {
            padding: 20px;
        }

        .contact-content h3 {
            color: #4b6cb7;
            margin-bottom: 15px;
        }

        .contact-content form .form-group label {
            font-weight: 500;
            color: #555555;
        }

        .contact-content form .form-control {
            border-radius: 10px;
            border: 1px solid #ced4da;
            padding: 12px 20px;
            transition: border-color 0.3s;
            background: #f0f8ff;
        }

        .contact-content form .form-control:focus {
            border-color: #4b6cb7;
            box-shadow: none;
            background: #e0f7fa;
        }

        .contact-content form .submit-btn {
            background: linear-gradient(45deg, #4b6cb7, #182848);
            color: #ffffff;
            border: none;
            padding: 12px 20px;
            border-radius: 10px;
            cursor: pointer;
            font-size: 1rem;
            transition: background 0.3s, transform 0.3s;
        }

        .contact-content form .submit-btn:hover {
            background: linear-gradient(45deg, #182848, #4b6cb7);
            transform: translateY(-3px);
        }

        /* Additional Styling for Registration Options */
        .registration-options {
            margin-bottom: 20px;
        }

        .registration-options label {
            margin-right: 20px;
            font-weight: 500;
        }

        /* Hide elements initially */
        .team-fields,
        .individual-fields {
            display: none;
        }
    </style>
</head>

<body>

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
                        Internal VSL CTF 2025 là cuộc thi lập trình - an toàn thông tin dành cho các sinh viên VKU yêu thích
                        thử thách và khám phá thế giới an ninh mạng. Hãy tham gia ngay cùng chúng mình để rèn luyện kỹ năng, giao
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
                        <p>Nếu bạn không phải là sinh viên VKU vui lòng gửi email đến vku.sec.lab@gmail.com để được hỗ trợ!</p>
                        <label>
                            <input type="radio" name="registration_type" value="team" checked>
                            Tôi có đội
                        </label>
                        <label>
                            <input type="radio" name="registration_type" value="individual">
                            Tôi chưa có đội
                        </label>
                    </div>

                    <!-- Thông Tin Đội -->
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

                        <!-- Số Lượng Thành Viên -->
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

                        <!-- Thông Tin Thành Viên -->
                        <div id="members-info"></div>
                    </div>

                    <!-- Thông Tin Cá Nhân -->
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

                        <!-- Ghi chú dành cho người đăng ký cá nhân -->
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
                        Các mốc thời gian quan trọng của cuộc thi CTF Internal VSL 2025 được liệt kê dưới đây: (Đây là các mốc thời gian dự kiến, có thể thay đổi tùy theo tình hình thực tế)
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
                        <b>Cuộc thi CTF (Capture The Flag) Internal VSL CTF 2025</b> là sự kiện dành cho các sinh viên yêu thích lĩnh vực an ninh mạng và lập trình, với mục tiêu khuyến khích học hỏi, rèn luyện kỹ năng giải quyết vấn đề và hợp tác trong việc vượt qua các thử thách. Được tổ chức bởi VKU Security Lab (VSL), câu lạc bộ an toàn thông tin của trường Đại học Công nghệ - Thông tin và Truyền thông Việt - Hàn (VKU), cuộc thi tạo cơ hội cho sinh viên trao đổi kiến thức, chia sẻ kinh nghiệm thực tiễn và kết nối cộng đồng lập trình viên, an ninh mạng trong trường.
                    </p>
                    <p>
                        <b>Hình thức tổ chức: </b>Cuộc thi được tổ chức theo hình thức thi trực tiếp theo đội tại trường Đại học Công nghệ - Thông tin và Truyền thông Việt - Hàn (VKU). Các đội thi sẽ cùng nhau giải quyết các thử thách trong thời gian giới hạn và nhận giải thưởng hấp dẫn từ BTC.
                        <br>
                        Có hai hình thức để tham gia:
                    <ul>
                        <li><b>Đăng ký theo đội:</b> Bao gồm tối đa 4 thành viên</li>
                        <li><b>Đăng ký cá nhân:</b> Nếu người đăng ký chưa có đội, btc sẽ xem xét và sắp xếp các bạn vào team phù hợp nếu người đăng ký có nhu cầu</li>
                    </ul>
                    </p>
                    <p>
                        <b>Thời gian tổ chức: </b>Thời gian dự kiến trong 1 ngày, từ 8:00 sáng ngày 04/01/2025 đến 16:00 chiều cùng ngày.
                    </p>
                    <p>
                        <b>Hình thức thi: </b>Jeopardy - Giải quyết các thử thách trên nhiều lĩnh vực an ninh mạng và lập trình.
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
                        <b>Thời hạn đăng ký: </b>Thời hạn đăng ký từ 20:00 ngày 16/12/2024 đến 21:00 ngày 30/12/2024.
                    </p>
                </div>
            </div>
            <!-- Prizes Tab -->
            <div class="tab-pane fade" id="prizes" role="tabpanel" aria-labelledby="prizes-tab">
                <div class="prizes-content">
                    <h3>Giải Thưởng</h3>
                    <ul class="prizes-list">
                        <li><i class="fas fa-trophy"></i>🏆 Vô Địch: <b>800,000 VND và kỷ niệm chương</b></li>
                        <li><i class="fas fa-medal"></i>🥇 Giải Nhất: <b>600,000 VND và kỷ niệm chương</b></li>
                        <li><i class="fas fa-award"></i>🥈 Giải Nhì: <b>400,000 VND và kỷ niệm chương</b></li>
                        <li><i class="fas fa-star"></i>🥉 Giải Ba: <b>200,000 VND và kỷ niệm chương</b></li>
                        <li><i class="fas fa-star"></i>Giải thưởng khác: <b>Đang bổ sung</b></li>

                    </ul>
                    <p>
                        Ngoài ra, tất cả các đội tham gia đều sẽ nhận được cơ hội tham gia các khóa học trực tuyến về an ninh mạng cũng như các phần quà hấp dẫn khác từ BTC.
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
                                Nếu bạn có bất kỳ câu hỏi hoặc góp ý nào, vui lòng điền vào biểu mẫu dưới đây. Chúng tôi sẽ phản hồi
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
                <a href="mailto:vku.sec.lab@gmail.com">
                    vku.sec.lab@gmail.com
                </a>
            </p>
        </footer>
    </div>
    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Custom JavaScript -->
    <script>
        // Countdown Timer Initialization
        function initializeCountdown() {
            const daysElement = document.getElementById('days');
            const hoursElement = document.getElementById('hours');
            const minutesElement = document.getElementById('minutes');
            const secondsElement = document.getElementById('seconds');
            const keyDates = [{
                    date: '2024-12-16T19:00:00+07:00',
                    label: 'Mở form đăng ký'
                },
                {
                    date: '2024-12-30T21:00:00+07:00',
                    label: 'Đóng form đăng ký'
                },
                {
                    date: '2025-01-03T08:00:00+07:00',
                    label: 'Sắp xếp địa điểm thi và mạng'
                },
                {
                    date: '2025-01-04T08:00:00+07:00',
                    label: 'Bắt đầu tổ chức thi'
                },
                {
                    date: '2025-01-04T16:00:00+07:00',
                    label: 'Kết thúc tổ chức thi'
                },
                {
                    date: '2025-01-04T17:00:00+07:00',
                    label: 'Trao giải'
                },
                {
                    date: '2025-01-05T09:00:00+07:00',
                    label: 'Đánh giá và tổng kết cuộc thi'
                },
                {
                    date: '2025-01-06T10:00:00+07:00',
                    label: 'Phản hồi và cải tiến cho năm tiếp theo'
                },
            ];

            // Chuyển đổi chuỗi ngày thành đối tượng Date
            keyDates.forEach(item => {
                item.date = new Date(item.date);
            });

            // Tạo Roadmap Items dựa trên keyDates
            function generateRoadmapItems() {
                const timelineContainer = document.getElementById('timeline');
                timelineContainer.innerHTML = ''; // Xóa nội dung hiện tại

                keyDates.forEach((item, index) => {
                    const side = index % 2 === 0 ? 'left' : 'right'; // Xác định vị trí left/right
                    const timelineItem = document.createElement('div');
                    timelineItem.classList.add('timeline-item', side);

                    const timelineContent = document.createElement('div');
                    timelineContent.classList.add('timeline-content');

                    const h3 = document.createElement('h3');
                    const icon = document.createElement('i');
                    // Tùy chỉnh icon dựa trên loại sự kiện
                    switch (item.label) {
                        case 'Mở form đăng ký':
                            icon.classList.add('fas', 'fa-calendar-check');
                            break;
                        case 'Đóng form đăng ký':
                            icon.classList.add('fas', 'fa-calendar-times');
                            break;
                        case 'Sắp xếp địa điểm thi và mạng':
                            icon.classList.add('fas', 'fa-tools');
                            break;
                        case 'Bắt đầu tổ chức thi':
                        case 'Kết thúc tổ chức thi':
                            icon.classList.add('fas', 'fa-running');
                            break;
                        case 'Trao giải':
                            icon.classList.add('fas', 'fa-trophy');
                            break;
                        case 'Đánh giá và tổng kết cuộc thi':
                            icon.classList.add('fas', 'fa-clipboard-check');
                            break;
                        case 'Phản hồi và cải tiến cho năm tiếp theo':
                            icon.classList.add('fas', 'fa-comment-dots');
                            break;
                        default:
                            icon.classList.add('fas', 'fa-calendar');
                    }

                    h3.appendChild(icon);
                    const options = {
                        year: 'numeric',
                        month: '2-digit',
                        day: '2-digit',
                        hour: '2-digit',
                        minute: '2-digit',
                        timeZone: 'Asia/Ho_Chi_Minh'
                    };
                    h3.innerHTML += ` ${item.label} - ${item.date.toLocaleString('vi-VN', options)}`;
                    const p = document.createElement('p');
                    p.textContent = `${item.label}`;

                    timelineContent.appendChild(h3);
                    timelineContent.appendChild(p);
                    timelineItem.appendChild(timelineContent);
                    timelineContainer.appendChild(timelineItem);
                });
            }

            generateRoadmapItems();

            function updateRoadmapHighlight() {
                const now = new Date();
                const timelineItems = document.querySelectorAll('.timeline-item');

                keyDates.forEach((item, index) => {
                    const timelineItem = timelineItems[index];
                    if (!timelineItem) {
                        console.warn(`Không tìm thấy timeline-item tại index ${index}.`);
                        return;
                    }
                    if (item.date < now) {
                        timelineItem.classList.add('completed');
                        timelineItem.classList.remove('highlight');
                    } else {
                        timelineItem.classList.remove('completed');
                        if (getNextEventIndex() === index) {
                            timelineItem.classList.add('highlight');
                        } else {
                            timelineItem.classList.remove('highlight');
                        }
                    }
                });
            }

            function getNextEventIndex() {
                const now = new Date();
                for (let i = 0; i < keyDates.length; i++) {
                    if (keyDates[i].date > now) {
                        return i;
                    }
                }
                return -1;
            }

            function highlightNextEvent() {
                updateRoadmapHighlight();
            }

            const targetDate = new Date('2024-12-30T21:00:00+07:00');

            function updateCountdown() {
                const now = new Date();
                const distance = targetDate - now;

                if (distance < 0) {
                    document.querySelector('.countdown-container').innerHTML = "<h4>Đã hết thời gian đăng ký.</h4>";
                    clearInterval(timerInterval);
                    document.getElementById('registration-form').querySelectorAll('input, select, button').forEach(element => {
                        element.disabled = true;
                    });
                    const timelineItems = document.querySelectorAll('.timeline-item');
                    timelineItems.forEach(item => {
                        item.classList.add('completed');
                        item.classList.remove('highlight');
                    });
                    return;
                }

                const days = Math.floor(distance / (1000 * 60 * 60 * 24));
                const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                const seconds = Math.floor((distance % (1000 * 60)) / 1000);

                daysElement.textContent = days.toString().padStart(2, '0');
                hoursElement.textContent = hours.toString().padStart(2, '0');
                minutesElement.textContent = minutes.toString().padStart(2, '0');
                secondsElement.textContent = seconds.toString().padStart(2, '0');

                highlightNextEvent();
            }

            updateCountdown();
            const timerInterval = setInterval(updateCountdown, 1000);
        }
        window.addEventListener('DOMContentLoaded', initializeCountdown);
        (function() {
            const membersSelect = document.getElementById('members');
            const membersInfoDiv = document.getElementById('members-info');
            const form = document.getElementById('registration-form');
            const alertContainer = document.getElementById('alert-container');
            const registrationTypeRadios = document.getElementsByName('registration_type');
            const teamFields = document.querySelector('.team-fields');
            const individualFields = document.querySelector('.individual-fields');

            function toggleRegistrationFields() {
                const selectedType = Array.from(registrationTypeRadios).find(radio => radio.checked).value;
                if (selectedType === 'team') {
                    teamFields.style.display = 'block';
                    individualFields.style.display = 'none';
                } else {
                    teamFields.style.display = 'none';
                    individualFields.style.display = 'block';
                }
            }
            toggleRegistrationFields();
            registrationTypeRadios.forEach(radio => {
                radio.addEventListener('change', toggleRegistrationFields);
            });

            function createMemberForm(index) {
                const memberDiv = document.createElement('div');
                memberDiv.classList.add('member-info');

                const memberTitle = document.createElement('h4');
                memberTitle.textContent = `Thông Tin Thành Viên ${index}`;
                memberDiv.appendChild(memberTitle);

                const nameGroup = document.createElement('div');
                nameGroup.classList.add('form-group', 'mb-3');
                const nameLabel = document.createElement('label');
                nameLabel.setAttribute('for', `member-name-${index}`);
                nameLabel.innerHTML = `Tên Thành Viên ${index} <span style="color: red;">*</span>`;
                const nameInput = document.createElement('input');
                nameInput.type = 'text';
                nameInput.id = `member-name-${index}`;
                nameInput.name = `members[${index}][name]`;
                nameInput.classList.add('form-control');
                nameInput.required = true;
                nameInput.placeholder = `Nhập tên thành viên ${index}`;
                const nameError = document.createElement('div');
                nameError.classList.add('error');
                nameError.id = `member-name-${index}-error`;
                nameGroup.appendChild(nameLabel);
                nameGroup.appendChild(nameInput);
                nameGroup.appendChild(nameError);
                memberDiv.appendChild(nameGroup);

                const usernameGroup = document.createElement('div');
                usernameGroup.classList.add('form-group', 'mb-3');
                const usernameLabel = document.createElement('label');
                usernameLabel.setAttribute('for', `member-username-${index}`);
                usernameLabel.innerHTML = `Username Thành Viên ${index} <span style="color: red;">*</span>`;
                const usernameInput = document.createElement('input');
                usernameInput.type = 'text';
                usernameInput.id = `member-username-${index}`;
                usernameInput.name = `members[${index}][username]`;
                usernameInput.classList.add('form-control');
                usernameInput.required = true;
                usernameInput.placeholder = `Nhập username thành viên ${index}`;
                const usernameError = document.createElement('div');
                usernameError.classList.add('error');
                usernameError.id = `member-username-${index}-error`;
                usernameGroup.appendChild(usernameLabel);
                usernameGroup.appendChild(usernameInput);
                usernameGroup.appendChild(usernameError);
                memberDiv.appendChild(usernameGroup);

                const idGroup = document.createElement('div');
                idGroup.classList.add('form-group', 'mb-3');
                const idLabel = document.createElement('label');
                idLabel.setAttribute('for', `member-id-${index}`);
                idLabel.innerHTML = `Mã Sinh Viên ${index} <span style="color: red;">*</span>`;
                const idInput = document.createElement('input');
                idInput.type = 'text';
                idInput.id = `member-id-${index}`;
                idInput.name = `members[${index}][student_id]`;
                idInput.classList.add('form-control');
                idInput.required = true;
                idInput.placeholder = `Nhập mã sinh viên ${index}`;
                const idError = document.createElement('div');
                idError.classList.add('error');
                idError.id = `member-id-${index}-error`;
                idGroup.appendChild(idLabel);
                idGroup.appendChild(idInput);
                idGroup.appendChild(idError);
                memberDiv.appendChild(idGroup);

                const emailGroup = document.createElement('div');
                emailGroup.classList.add('form-group', 'mb-3');
                const emailLabel = document.createElement('label');
                emailLabel.setAttribute('for', `member-email-${index}`);
                emailLabel.innerHTML = `Email Trường Thành Viên ${index} <span style="color: red;">*</span>`;
                const emailInput = document.createElement('input');
                emailInput.type = 'email';
                emailInput.id = `member-email-${index}`;
                emailInput.name = `members[${index}][email]`;
                emailInput.classList.add('form-control');
                emailInput.required = true;
                emailInput.placeholder = `example@vku.udn.vn`;
                emailInput.pattern = "^[a-zA-Z0-9._%+-]+@vku\\.udn\\.vn$";
                const emailError = document.createElement('div');
                emailError.classList.add('error');
                emailError.id = `member-email-${index}-error`;
                emailGroup.appendChild(emailLabel);
                emailGroup.appendChild(emailInput);
                emailGroup.appendChild(emailError);
                memberDiv.appendChild(emailGroup);

                const facultyGroup = document.createElement('div');
                facultyGroup.classList.add('form-group', 'mb-3');
                const facultyLabel = document.createElement('label');
                facultyLabel.setAttribute('for', `member-faculty-${index}`);
                facultyLabel.innerHTML = `Khoa Thành Viên ${index} <span style="color: red;">*</span>`;
                const facultySelect = document.createElement('select');
                facultySelect.id = `member-faculty-${index}`;
                facultySelect.name = `members[${index}][faculty]`;
                facultySelect.classList.add('form-select');
                facultySelect.required = true;

                const facultyOptions = [{
                        value: "",
                        text: "Chọn Khoa"
                    },
                    {
                        value: "Khoa Khoa học máy tính",
                        text: "Khoa Khoa học máy tính"
                    },
                    {
                        value: "Khoa Kỹ thuật máy tính và Điện tử",
                        text: "Khoa Kỹ thuật máy tính và Điện tử"
                    },
                    {
                        value: "Khoa Kinh tế số và Thương mại điện tử",
                        text: "Khoa Kinh tế số và Thương mại điện tử"
                    },
                    {
                        value: "Khác",
                        text: "Khác"
                    }
                ];

                facultyOptions.forEach(optionData => {
                    const option = document.createElement('option');
                    option.value = optionData.value;
                    option.textContent = optionData.text;
                    if (optionData.value === "") {
                        option.disabled = true;
                        option.selected = true;
                    }
                    facultySelect.appendChild(option);
                });

                const facultyError = document.createElement('div');
                facultyError.classList.add('error');
                facultyError.id = `member-faculty-${index}-error`;
                facultyGroup.appendChild(facultyLabel);
                facultyGroup.appendChild(facultySelect);
                facultyGroup.appendChild(facultyError);
                memberDiv.appendChild(facultyGroup);

                return memberDiv;
            }

            membersSelect.addEventListener('change', function() {
                const numberOfMembers = parseInt(this.value);
                membersInfoDiv.innerHTML = '';
                for (let i = 1; i <= numberOfMembers; i++) {
                    const memberForm = createMemberForm(i);
                    membersInfoDiv.appendChild(memberForm);
                }
            });

            form.addEventListener('submit', function(event) {
                event.preventDefault();
                let isValid = true;
                const errors = form.querySelectorAll('.error');
                errors.forEach(error => {
                    error.style.display = 'none';
                    error.textContent = '';
                });

                const registrationType = Array.from(registrationTypeRadios).find(radio => radio.checked).value;

                if (registrationType === 'team') {
                    const teamName = document.getElementById('team-name');
                    if (teamName.value.trim() === '') {
                        isValid = false;
                        const error = document.getElementById('team-name-error');
                        error.textContent = 'Vui lòng nhập tên đội.';
                        error.style.display = 'block';
                    }

                    const teamEmail = document.getElementById('email');
                    const emailPattern = /^[a-zA-Z0-9._%+-]+@vku\.udn\.vn$/;
                    if (!emailPattern.test(teamEmail.value.trim())) {
                        isValid = false;
                        const error = document.getElementById('email-error');
                        error.textContent = 'Email phải kết thúc bằng @vku.udn.vn.';
                        error.style.display = 'block';
                    }

                    const phone = document.getElementById('phone');
                    const phonePattern = /^\+?\d{10,15}$/;
                    if (!phonePattern.test(phone.value.trim())) {
                        isValid = false;
                        const error = document.getElementById('phone-error');
                        error.textContent = 'Vui lòng nhập số điện thoại hợp lệ (10-15 chữ số).';
                        error.style.display = 'block';
                    }

                    const members = document.getElementById('members');
                    if (members.value === "") {
                        isValid = false;
                        const error = document.getElementById('members-error');
                        error.textContent = 'Vui lòng chọn số lượng thành viên.';
                        error.style.display = 'block';
                    }

                    const numberOfMembers = parseInt(members.value);
                    for (let i = 1; i <= numberOfMembers; i++) {
                        const memberName = document.getElementById(`member-name-${i}`);
                        if (memberName.value.trim() === '') {
                            isValid = false;
                            const error = document.getElementById(`member-name-${i}-error`);
                            error.textContent = 'Vui lòng nhập tên thành viên.';
                            error.style.display = 'block';
                        }

                        const memberUsername = document.getElementById(`member-username-${i}`);
                        if (memberUsername.value.trim() === '') {
                            isValid = false;
                            const error = document.getElementById(`member-username-${i}-error`);
                            error.textContent = 'Vui lòng nhập username thành viên.';
                            error.style.display = 'block';
                        }
                        const memberID = document.getElementById(`member-id-${i}`);
                        if (memberID.value.trim() === '') {
                            isValid = false;
                            const error = document.getElementById(`member-id-${i}-error`);
                            error.textContent = 'Vui lòng nhập mã sinh viên.';
                            error.style.display = 'block';
                        }
                        const memberEmail = document.getElementById(`member-email-${i}`);
                        if (!emailPattern.test(memberEmail.value.trim())) {
                            isValid = false;
                            const error = document.getElementById(`member-email-${i}-error`);
                            error.textContent = 'Email phải kết thúc bằng @vku.udn.vn.';
                            error.style.display = 'block';
                        }
                        const memberFaculty = document.getElementById(`member-faculty-${i}`);
                        if (memberFaculty.value === "") {
                            isValid = false;
                            const error = document.getElementById(`member-faculty-${i}-error`);
                            error.textContent = 'Vui lòng chọn khoa.';
                            error.style.display = 'block';
                        }
                    }
                } else if (registrationType === 'individual') {
                    const individualName = document.getElementById('individual-name');
                    if (individualName.value.trim() === '') {
                        isValid = false;
                        const error = document.getElementById('individual-name-error');
                        error.textContent = 'Vui lòng nhập tên.';
                        error.style.display = 'block';
                    }

                    const individualEmail = document.getElementById('individual-email');
                    const emailPattern = /^[a-zA-Z0-9._%+-]+@vku\.udn\.vn$/;
                    if (!emailPattern.test(individualEmail.value.trim())) {
                        isValid = false;
                        const error = document.getElementById('individual-email-error');
                        error.textContent = 'Email phải kết thúc bằng @vku.udn.vn.';
                        error.style.display = 'block';
                    }

                    const individualPhone = document.getElementById('individual-phone');
                    const phonePattern = /^\+?\d{10,15}$/;
                    if (!phonePattern.test(individualPhone.value.trim())) {
                        isValid = false;
                        const error = document.getElementById('individual-phone-error');
                        error.textContent = 'Vui lòng nhập số điện thoại hợp lệ (10-15 chữ số).';
                        error.style.display = 'block';
                    }

                    const individualFaculty = document.getElementById('individual-faculty');
                    if (individualFaculty.value === "") {
                        isValid = false;
                        const error = document.getElementById('individual-faculty-error');
                        error.textContent = 'Vui lòng chọn khoa.';
                        error.style.display = 'block';
                    }
                }

                if (!isValid) {
                    window.scrollTo({
                        top: 0,
                        behavior: 'smooth'
                    });
                    return;
                }

                let formData = {};

                if (registrationType === 'team') {
                    const teamName = document.getElementById('team-name').value.trim();
                    const teamEmail = document.getElementById('email').value.trim();
                    const phone = document.getElementById('phone').value.trim();
                    const membersSelectValue = document.getElementById('members').value;
                    const numberOfMembers = parseInt(membersSelectValue);
                    formData = {
                        registration_type: 'team',
                        team_name: teamName,
                        email: teamEmail,
                        phone: phone,
                        members: []
                    };

                    for (let i = 1; i <= numberOfMembers; i++) {
                        const member = {
                            name: document.getElementById(`member-name-${i}`).value.trim(),
                            username: document.getElementById(`member-username-${i}`).value.trim(),
                            student_id: document.getElementById(`member-id-${i}`).value.trim(),
                            email: document.getElementById(`member-email-${i}`).value.trim(),
                            faculty: document.getElementById(`member-faculty-${i}`).value.trim()
                        };
                        formData.members.push(member);
                    }
                } else if (registrationType === 'individual') {
                    const individualName = document.getElementById('individual-name').value.trim();
                    const individualEmail = document.getElementById('individual-email').value.trim();
                    const individualPhone = document.getElementById('individual-phone').value.trim();
                    const individualFaculty = document.getElementById('individual-faculty').value.trim();
                    const student_id = document.getElementById('individual-msv').value.trim();
                    formData = {
                        registration_type: 'individual',
                        name: individualName,
                        email: individualEmail,
                        phone: individualPhone,
                        faculty: individualFaculty,
                        student_id: student_id
                    };
                }

                fetch('submit-registration.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify(formData)
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            alertContainer.innerHTML = `
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    ${data.message}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            `;
                            form.reset();
                            membersInfoDiv.innerHTML = '';
                            toggleRegistrationFields();
                        } else {
                            alertContainer.innerHTML = `
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    ${data.message}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            `;
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alertContainer.innerHTML = `
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                Đã xảy ra lỗi khi gửi dữ liệu. Vui lòng thử lại sau.
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        `;
                    });
            });
        })();
        (function() {
            const contactForm = document.getElementById('contact-form');
            const alertContainer = document.getElementById('alert-container');

            contactForm.addEventListener('submit', function(event) {
                event.preventDefault();
                let isValid = true;
                const errors = contactForm.querySelectorAll('.error');
                errors.forEach(error => {
                    error.style.display = 'none';
                    error.textContent = '';
                });

                const contactName = document.getElementById('contact-name');
                const contactEmail = document.getElementById('contact-email');
                const contactMessage = document.getElementById('contact-message');
                const contactEmailPattern = /^[a-zA-Z0-9._%+-]+@vku\.udn\.vn$/;

                if (contactName.value.trim() === '') {
                    isValid = false;
                    const error = document.getElementById('contact-name-error');
                    error.textContent = 'Vui lòng nhập tên.';
                    error.style.display = 'block';
                }

                if (!contactEmailPattern.test(contactEmail.value.trim())) {
                    isValid = false;
                    const error = document.getElementById('contact-email-error');
                    error.textContent = 'Email phải kết thúc bằng @vku.udn.vn.';
                    error.style.display = 'block';
                }

                if (contactMessage.value.trim() === '') {
                    isValid = false;
                    const error = document.getElementById('contact-message-error');
                    error.textContent = 'Vui lòng nhập tin nhắn.';
                    error.style.display = 'block';
                }

                if (!isValid) {
                    window.scrollTo({
                        top: 0,
                        behavior: 'smooth'
                    });
                    return;
                }

                const contactData = {
                    name: contactName.value.trim(),
                    email: contactEmail.value.trim(),
                    message: contactMessage.value.trim()
                };

                fetch('submit-contact.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify(contactData)
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            alertContainer.innerHTML = `
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    ${data.message}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            `;
                            contactForm.reset();
                        } else {
                            alertContainer.innerHTML = `
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    ${data.message}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            `;
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alertContainer.innerHTML = `
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <!-- Đã xảy ra lỗi khi gửi dữ liệu. Vui lòng thử lại sau. -->
                                Tính năng đang được phát triển, bạn có thể liên hệ trực tiếp qua email: vku.sec.lab@gmail.com
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        `;
                    });
            });
        })();
        window.addEventListener('load', function() {
            var script = document.createElement('script');
            script.src = "assets/js/snowfall-effect.js";
            script.async = true;
            document.head.appendChild(script);
        });
    </script>
</body>

</html>