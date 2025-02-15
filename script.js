BX24.init(function () {
  document
    .getElementById("contactForm")
    .addEventListener("submit", function (event) {
      event.preventDefault();

      const formData = new FormData(this);
      const leadData = {
        fields: {
          TITLE: "Задать вопрос",
          NAME: formData.get("name") || "",
          EMAIL: formData.get("email") || "",
          PHONE: [
            {
              VALUE: formData.get("phone") || "",
              VALUE_TYPE: "WORK",
            },
          ],
          MESSAGE: formData.get("message") || "",
          STATUS_ID: "NEW",
          OPENED: "Y",
        },
        params: {
          REGISTER_SONET_EVENT: "Y",
        },
      };

      if (
        !leadData.fields.NAME ||
        !leadData.fields.EMAIL ||
        !leadData.fields.PHONE[0].VALUE
      ) {
        alert(
          "Пожалуйста, заполните все обязательные поля: имя, email и телефон."
        );
        return;
      }

      BX24.callMethod("crm.lead.add", leadData, (result) => {
        if (result.error()) {
          console.error("Ошибка при создании лида:", result.error());
          alert(
            "Не удалось создать лид. Пожалуйста, проверьте данные и попробуйте снова."
          );
          return;
        }
        console.info(`Создан лид с ID ${result.data()}`);
        alert(`Лид успешно создан с ID: ${result.data()}`);
        this.reset();
      });
    });
});
