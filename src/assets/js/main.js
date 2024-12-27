// Immediately Invoked Function Expression (IIFE) to encapsulate the code
(function () {
    // Registration Form Handling
    const registrationTypeRadios = document.getElementsByName('registration_type');
    const externalMembersInfoDiv = document.getElementById('external-members-info');
    const externalMembersSelect = document.getElementById('external-members');
    const membersSelect = document.getElementById('members');
    const membersInfoDiv = document.getElementById('members-info');
    const form = document.getElementById('registration-form');
    const alertContainer = document.getElementById('alert-container');

    // Function to toggle registration fields based on selected type
    function toggleRegistrationFields() {
        const selectedType = Array.from(registrationTypeRadios).find(radio => radio.checked).value;
        const teamFields = document.querySelector('.team-fields');
        const individualFields = document.querySelector('.individual-fields');
        const externalTeamFields = document.querySelector('.external-team-fields');

        if (teamFields) teamFields.style.display = 'none';
        if (individualFields) individualFields.style.display = 'none';
        if (externalTeamFields) externalTeamFields.style.display = 'none';

        if (selectedType === 'team') {
            if (teamFields) teamFields.style.display = 'block';
        } else if (selectedType === 'individual') {
            if (individualFields) individualFields.style.display = 'block';
        } else if (selectedType === 'external_team') {
            if (externalTeamFields) externalTeamFields.style.display = 'block';
        }
    }

    // Function to create external member forms dynamically (without student_id and faculty)
    function createExternalMemberForm(index) {
        const memberDiv = document.createElement('div');
        memberDiv.classList.add('member-info');

        const memberTitle = document.createElement('h4');
        memberTitle.textContent = `Thông Tin Thành Viên ${index}`;
        memberDiv.appendChild(memberTitle);

        const fields = [{
            id: 'name',
            label: 'Tên',
            placeholder: `Nhập tên thành viên ${index}`
        },
        {
            id: 'username',
            label: 'Username',
            placeholder: `Nhập username thành viên ${index}`
        },
        {
            id: 'email',
            label: 'Email',
            placeholder: `example@example.com`,
            pattern: /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/
        }
        ];

        fields.forEach(field => {
            const group = document.createElement('div');
            group.classList.add('form-group', 'mb-3');

            const label = document.createElement('label');
            label.setAttribute('for', `external-member-${field.id}-${index}`);
            label.innerHTML = `${field.label} <span style="color: red;">*</span>`;

            const input = document.createElement('input');
            input.type = field.id === 'email' ? 'email' : 'text';
            input.id = `external-member-${field.id}-${index}`;
            input.name = `external_members[${index}][${field.id}]`;
            input.classList.add('form-control');
            input.required = true;
            input.placeholder = field.placeholder;
            if (field.pattern) input.pattern = field.pattern.source;

            const error = document.createElement('div');
            error.classList.add('error');
            error.id = `external-member-${field.id}-${index}-error`;

            group.appendChild(label);
            group.appendChild(input);
            group.appendChild(error);
            memberDiv.appendChild(group);
        });

        return memberDiv;
    }

    function createInternalMemberForm(index) {
        const memberDiv = document.createElement('div');
        memberDiv.classList.add('member-info');

        const memberTitle = document.createElement('h4');
        memberTitle.textContent = `Thông Tin Thành Viên ${index}`;
        memberDiv.appendChild(memberTitle);

        const fields = [{
            id: 'name',
            label: `Tên Thành Viên ${index}`,
            placeholder: `Nhập tên thành viên ${index}`
        },
        {
            id: 'username',
            label: `Username Thành Viên ${index}`,
            placeholder: `Nhập username thành viên ${index}`
        },
        {
            id: 'student-id',
            label: `Mã Sinh Viên ${index}`,
            placeholder: `Nhập mã sinh viên ${index}`
        },
        {
            id: 'email',
            label: `Email Trường Thành Viên ${index}`,
            placeholder: `example@vku.udn.vn`,
            pattern: /^[a-zA-Z0-9._%+-]+@vku\.udn\.vn$/
        }
        ];

        fields.forEach(field => {
            const group = document.createElement('div');
            group.classList.add('form-group', 'mb-3');

            const label = document.createElement('label');
            label.setAttribute('for', `member-${field.id}-${index}`);
            label.innerHTML = `${field.label} <span style="color: red;">*</span>`;

            const input = document.createElement('input');
            input.type = field.id === 'email' ? 'email' : 'text';
            input.id = `member-${field.id}-${index}`;
            input.name = `members[${index}][${field.id}]`;
            input.classList.add('form-control');
            input.required = true;
            input.placeholder = field.placeholder;
            if (field.pattern) input.pattern = field.pattern.source;

            const error = document.createElement('div');
            error.classList.add('error');
            error.id = `member-${field.id}-${index}-error`;

            group.appendChild(label);
            group.appendChild(input);
            group.appendChild(error);
            memberDiv.appendChild(group);
        });
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
            text: "Chọn Khoa",
            disabled: true,
            selected: true
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
            if (optionData.disabled) {
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

    function showError(elementId, message) {
        const errorElement = document.getElementById(elementId);
        if (errorElement) {
            errorElement.textContent = message;
            errorElement.style.display = 'block';
        }
    }
    if (registrationTypeRadios.length > 0) {
        Array.from(registrationTypeRadios).forEach(radio => {
            radio.addEventListener('change', toggleRegistrationFields);
        });
    }
    toggleRegistrationFields();
    if (externalMembersSelect) {
        externalMembersSelect.addEventListener('change', function () {
            const numberOfMembers = parseInt(this.value);
            if (externalMembersInfoDiv) {
                externalMembersInfoDiv.innerHTML = '';
                for (let i = 1; i <= numberOfMembers; i++) {
                    const memberForm = createExternalMemberForm(i);
                    externalMembersInfoDiv.appendChild(memberForm);
                }
            }
        });
    }
    if (membersSelect) {
        membersSelect.addEventListener('change', function () {
            const numberOfMembers = parseInt(this.value);
            if (membersInfoDiv) {
                membersInfoDiv.innerHTML = '';
                for (let i = 1; i <= numberOfMembers; i++) {
                    const memberForm = createInternalMemberForm(i);
                    membersInfoDiv.appendChild(memberForm);
                }
            }
        });
    }
    if (form) {
        form.addEventListener('submit', function (event) {
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
                if (teamName && teamName.value.trim() === '') {
                    isValid = false;
                    showError('team-name-error', 'Vui lòng nhập tên đội.');
                }

                const teamEmail = document.getElementById('email');
                const emailPattern = /^[a-zA-Z0-9._%+-]+@vku\.udn\.vn$/;
                if (teamEmail && !emailPattern.test(teamEmail.value.trim())) {
                    isValid = false;
                    showError('email-error', 'Email phải kết thúc bằng @vku.udn.vn.');
                }

                const phone = document.getElementById('phone');
                const phonePattern = /^\+?\d{10,15}$/;
                if (phone && !phonePattern.test(phone.value.trim())) {
                    isValid = false;
                    showError('phone-error', 'Vui lòng nhập số điện thoại hợp lệ (10-15 chữ số).');
                }

                const members = document.getElementById('members');
                if (members && members.value === "") {
                    isValid = false;
                    showError('members-error', 'Vui lòng chọn số lượng thành viên.');
                }

                const numberOfMembers = members ? parseInt(members.value) : 0;
                for (let i = 1; i <= numberOfMembers; i++) {
                    const memberName = document.getElementById(`member-name-${i}`);
                    if (memberName && memberName.value.trim() === '') {
                        isValid = false;
                        showError(`member-name-${i}-error`, 'Vui lòng nhập tên thành viên.');
                    }

                    const memberUsername = document.getElementById(`member-username-${i}`);
                    if (memberUsername && memberUsername.value.trim() === '') {
                        isValid = false;
                        showError(`member-username-${i}-error`, 'Vui lòng nhập username thành viên.');
                    }

                    const memberID = document.getElementById(`member-student-id-${i}`);
                    if (memberID && memberID.value.trim() === '') {
                        isValid = false;
                        showError(`member-student-id-${i}-error`, 'Vui lòng nhập mã sinh viên.');
                    }
                    const memberEmail = document.getElementById(`member-email-${i}`);
                    if (memberEmail && !emailPattern.test(memberEmail.value.trim())) {
                        isValid = false;
                        showError(`member-email-${i}-error`, 'Email phải kết thúc bằng @vku.udn.vn.');
                    }

                    const memberFaculty = document.getElementById(`member-faculty-${i}`);
                    if (memberFaculty && memberFaculty.value === "") {
                        isValid = false;
                        showError(`member-faculty-${i}-error`, 'Vui lòng chọn khoa.');
                    }
                }
            } else if (registrationType === 'individual') {
                const individualName = document.getElementById('individual-name');
                if (individualName && individualName.value.trim() === '') {
                    isValid = false;
                    showError('individual-name-error', 'Vui lòng nhập tên.');
                }

                const individualEmail = document.getElementById('individual-email');
                const emailPattern = /^[a-zA-Z0-9._%+-]+@vku\.udn\.vn$/;
                if (individualEmail && !emailPattern.test(individualEmail.value.trim())) {
                    isValid = false;
                    showError('individual-email-error', 'Email phải kết thúc bằng @vku.udn.vn.');
                }

                const individualPhone = document.getElementById('individual-phone');
                const phonePattern = /^\+?\d{10,15}$/;
                if (individualPhone && !phonePattern.test(individualPhone.value.trim())) {
                    isValid = false;
                    showError('individual-phone-error', 'Vui lòng nhập số điện thoại hợp lệ (10-15 chữ số).');
                }

                const individualFaculty = document.getElementById('individual-faculty');
                if (individualFaculty && individualFaculty.value === "") {
                    isValid = false;
                    showError('individual-faculty-error', 'Vui lòng chọn khoa.');
                }

                const individualMSV = document.getElementById('individual-msv');
                if (individualMSV && individualMSV.value.trim() === '') {
                    isValid = false;
                    showError('individual-msv-error', 'Vui lòng nhập mã sinh viên.');
                }
            } else if (registrationType === 'external_team') {
                const externalTeamName = document.getElementById('external-team-name');
                if (externalTeamName && externalTeamName.value.trim() === '') {
                    isValid = false;
                    showError('external-team-name-error', 'Vui lòng nhập tên đội.');
                }

                const externalSchoolName = document.getElementById('external-school-name');
                if (externalSchoolName && externalSchoolName.value.trim() === '') {
                    isValid = false;
                    showError('external-school-name-error', 'Vui lòng nhập tên trường.');
                }

                const externalEmail = document.getElementById('external-email');
                const emailPatternExternal = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
                if (externalEmail && !emailPatternExternal.test(externalEmail.value.trim())) {
                    isValid = false;
                    showError('external-email-error', 'Vui lòng nhập email hợp lệ.');
                }

                const externalPhone = document.getElementById('external-phone');
                const phonePatternExternal = /^\+?\d{10,15}$/;
                if (externalPhone && !phonePatternExternal.test(externalPhone.value.trim())) {
                    isValid = false;
                    showError('external-phone-error', 'Vui lòng nhập số điện thoại hợp lệ (10-15 chữ số).');
                }

                const externalMembers = document.getElementById('external-members');
                if (externalMembers && externalMembers.value === "") {
                    isValid = false;
                    showError('external-members-error', 'Vui lòng chọn số lượng thành viên.');
                }

                const numberOfExternalMembers = externalMembers ? parseInt(externalMembers.value) : 0;
                for (let i = 1; i <= numberOfExternalMembers; i++) {
                    const memberName = document.getElementById(`external-member-name-${i}`);
                    if (memberName && memberName.value.trim() === '') {
                        isValid = false;
                        showError(`external-member-name-${i}-error`, 'Vui lòng nhập tên thành viên.');
                    }

                    const memberUsername = document.getElementById(`external-member-username-${i}`);
                    if (memberUsername && memberUsername.value.trim() === '') {
                        isValid = false;
                        showError(`external-member-username-${i}-error`, 'Vui lòng nhập username thành viên.');
                    }

                    const memberEmail = document.getElementById(`external-member-email-${i}`);
                    if (memberEmail && !emailPatternExternal.test(memberEmail.value.trim())) {
                        isValid = false;
                        showError(`external-member-email-${i}-error`, 'Email phải hợp lệ.');
                    }
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

            if (registrationType === 'team' || registrationType === 'external_team') {
                const isExternal = registrationType === 'external_team';
                const prefix = isExternal ? 'external-' : '';
                const teamName = isExternal ? (document.getElementById(`${prefix}team-name`) ? document.getElementById(`${prefix}team-name`).value.trim() : '') : (document.getElementById('team-name') ? document.getElementById('team-name').value.trim() : '');
                const email = isExternal ? (document.getElementById(`${prefix}email`) ? document.getElementById(`${prefix}email`).value.trim() : '') : (document.getElementById('email') ? document.getElementById('email').value.trim() : '');
                const phone = isExternal ? (document.getElementById(`${prefix}phone`) ? document.getElementById(`${prefix}phone`).value.trim() : '') : (document.getElementById('phone') ? document.getElementById('phone').value.trim() : '');
                const membersSelectValue = isExternal ? (document.getElementById(`${prefix}members`) ? document.getElementById(`${prefix}members`).value : '') : (document.getElementById('members') ? document.getElementById('members').value : '');
                const numberOfMembers = parseInt(membersSelectValue) || 0;

                formData = isExternal ? {
                    registration_type: 'external_team',
                    external_team_name: teamName,
                    external_school_name: (document.getElementById('external-school-name') ? document.getElementById('external-school-name').value.trim() : ''),
                    external_email: email,
                    external_phone: phone,
                    external_members: []
                } : {
                    registration_type: 'team',
                    team_name: teamName,
                    email: email,
                    phone: phone,
                    members: []
                };

                for (let i = 1; i <= numberOfMembers; i++) {
                    const name = isExternal ? (document.getElementById(`external-member-name-${i}`) ? document.getElementById(`external-member-name-${i}`).value.trim() : '') : (document.getElementById(`member-name-${i}`) ? document.getElementById(`member-name-${i}`).value.trim() : '');
                    const username = isExternal ? (document.getElementById(`external-member-username-${i}`) ? document.getElementById(`external-member-username-${i}`).value.trim() : '') : (document.getElementById(`member-username-${i}`) ? document.getElementById(`member-username-${i}`).value.trim() : '');
                    const emailMember = isExternal ? (document.getElementById(`external-member-email-${i}`) ? document.getElementById(`external-member-email-${i}`).value.trim() : '') : (document.getElementById(`member-email-${i}`) ? document.getElementById(`member-email-${i}`).value.trim() : '');

                    if (isExternal) {
                        formData.external_members.push({
                            name,
                            username,
                            email: emailMember
                        });
                    } else {
                        const memberID = document.getElementById(`member-student-id-${i}`) ? document.getElementById(`member-student-id-${i}`).value.trim() : '';
                        const memberFaculty = document.getElementById(`member-faculty-${i}`) ? document.getElementById(`member-faculty-${i}`).value.trim() : '';
                        formData.members.push({
                            name,
                            username,
                            student_id: memberID,
                            email: emailMember,
                            faculty: memberFaculty
                        });
                    }
                }
            } else if (registrationType === 'individual') {
                const individualName = document.getElementById('individual-name') ? document.getElementById('individual-name').value.trim() : '';
                const individualEmail = document.getElementById('individual-email') ? document.getElementById('individual-email').value.trim() : '';
                const individualPhone = document.getElementById('individual-phone') ? document.getElementById('individual-phone').value.trim() : '';
                const individualFaculty = document.getElementById('individual-faculty') ? document.getElementById('individual-faculty').value.trim() : '';
                const student_id = document.getElementById('individual-msv') ? document.getElementById('individual-msv').value.trim() : '';
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
                        externalMembersInfoDiv.innerHTML = '';
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
    }
})();

// Contact Form Handling
(function () {
    const contactForm = document.getElementById('contact-form');
    const alertContainer = document.getElementById('alert-container');

    // Function to display error messages
    function showError(elementId, message) {
        const errorElement = document.getElementById(elementId);
        if (errorElement) {
            errorElement.textContent = message;
            errorElement.style.display = 'block';
        }
    }

    if (contactForm) {
        contactForm.addEventListener('submit', function (event) {
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

            if (contactName && contactName.value.trim() === '') {
                isValid = false;
                showError('contact-name-error', 'Vui lòng nhập tên.');
            }

            if (contactEmail && !contactEmailPattern.test(contactEmail.value.trim())) {
                isValid = false;
                showError('contact-email-error', 'Email phải kết thúc bằng @vku.udn.vn.');
            }

            if (contactMessage && contactMessage.value.trim() === '') {
                isValid = false;
                showError('contact-message-error', 'Vui lòng nhập tin nhắn.');
            }

            if (!isValid) {
                window.scrollTo({
                    top: 0,
                    behavior: 'smooth'
                });
                return;
            }

            const contactData = {
                name: contactName ? contactName.value.trim() : '',
                email: contactEmail ? contactEmail.value.trim() : '',
                message: contactMessage ? contactMessage.value.trim() : ''
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
                                    Tính năng đang được phát triển, bạn có thể liên hệ trực tiếp qua email: vku.sec.lab@gmail.com
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            `;
                });
        });
    }
})();

// Initialize Countdown Timer and Roadmap
function initializeCountdown() {
    initAudio();
    const daysElement = document.getElementById('days');
    const hoursElement = document.getElementById('hours');
    const minutesElement = document.getElementById('minutes');
    const secondsElement = document.getElementById('seconds');
    const keyDates = [{
        date: '2024-12-16T19:00:00+07:00',
        label: 'Mở form đăng ký'
    },
    {
        date: '2024-12-31T21:00:00+07:00',
        label: 'Đóng form đăng ký'
    },
    {
        date: '2025-01-11T08:00:00+07:00',
        label: 'Sắp xếp địa điểm thi và mạng'
    },
    {
        date: '2025-01-12T08:00:00+07:00',
        label: 'Bắt đầu tổ chức thi'
    },
    {
        date: '2025-01-12T18:00:00+07:00',
        label: 'Kết thúc tổ chức thi'
    },
    {
        date: '2025-01-12T18:20:00+07:00',
        label: 'Trao giải'
    },
    {
        date: '2025-01-12T18:30:00+07:00',
        label: 'Đánh giá và tổng kết cuộc thi'
    },
    {
        date: '2025-01-12T19:00:00+07:00',
        label: 'Phản hồi và cải tiến cho năm tiếp theo'
    },
    ];
    keyDates.forEach(item => {
        item.date = new Date(item.date);
    });

    function generateRoadmapItems() {
        const timelineContainer = document.getElementById('timeline');
        timelineContainer.innerHTML = '';
        keyDates.forEach((item, index) => {
            const side = index % 2 === 0 ? 'left' : 'right';
            const timelineItem = document.createElement('div');
            timelineItem.classList.add('timeline-item', side);

            const timelineContent = document.createElement('div');
            timelineContent.classList.add('timeline-content');

            const h3 = document.createElement('h3');
            const icon = document.createElement('i');
            // Customize icon based on event type
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

    const targetDate = new Date('2024-12-31T21:00:00+07:00');

    function updateCountdown() {
        const now = new Date();
        const distance = targetDate - now;

        if (distance < 0) {
            const countdownContainer = document.querySelector('.countdown-container');
            if (countdownContainer) {
                countdownContainer.innerHTML = "<h4>Đã hết thời gian đăng ký.</h4>";
            }
            clearInterval(timerInterval);
            const registrationForm = document.getElementById('registration-form');
            if (registrationForm) {
                registrationForm.querySelectorAll('input, select, button').forEach(element => {
                    element.disabled = true;
                });
            }
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

        if (daysElement) daysElement.textContent = days.toString().padStart(2, '0');
        if (hoursElement) hoursElement.textContent = hours.toString().padStart(2, '0');
        if (minutesElement) minutesElement.textContent = minutes.toString().padStart(2, '0');
        if (secondsElement) secondsElement.textContent = seconds.toString().padStart(2, '0');

        highlightNextEvent();
    }

    updateCountdown();
    const timerInterval = setInterval(updateCountdown, 1000);
}

// Auto play music
const initAudio = () => {
    const audio = new Audio('assets/sound/playback.mp3');
    audio.loop = true;

    const startAudio = () => {
        audio.play()
            .then(() => {
                console.log('Audio playback started');
            })
            .catch((error) => {
                console.error('Failed to start audio playback:', error);
            });
        document.removeEventListener('click', startAudio);
    };

    document.addEventListener('click', startAudio);
};


window.addEventListener('DOMContentLoaded', initializeCountdown);

// Load Snowfall Effect Script
window.addEventListener('load', function () {
    var script = document.createElement('script');
    script.src = "assets/js/snowfall-effect.js";
    script.async = true;
    document.head.appendChild(script);
});