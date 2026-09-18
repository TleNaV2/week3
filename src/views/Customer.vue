<template>
  <div class="customers-container">
    <div class="header-row">
      <h2 class="mb-0">รายชื่อลูกค้า</h2>
      <router-link to="/add-customer" class="btn btn-primary">เพิ่มลูกค้า</router-link>
    </div>

    <table class="table table-bordered table-striped">
      <thead class="table-dark">
        <tr>
          <th>ลำดับที่</th>
          <th>รหัสลูกค้า</th>
          <th>ชื่อ</th>
          <th>นามสกุล</th>
          <th>เบอร์โทร</th>
          <th>ชื่อผู้ใช้</th>
        </tr>
      </thead>

      <tbody>
        <tr v-for="(item, index) in customers" :key="item.customer_id">
          <td>{{ index + 1 }}</td>
          <td>{{ item.customer_id }}</td>
          <td>{{ item.firstName }}</td>
          <td>{{ item.lastName }}</td>
          <td>{{ item.phone }}</td>
          <td>{{ item.username }}</td>
        </tr>
      </tbody>
    </table>

    <div v-if="loading" class="text-center">
      <p>กำลังโหลดข้อมูล...</p>
    </div>

    <div v-if="error" class="alert alert-danger">
      {{ error }}
    </div>
  </div>
</template>

<script>
import { ref, onMounted } from "vue";

export default {
  name: "CustomerList",

  setup() {
    const customers = ref([]);
    const loading = ref(true);
    const error = ref(null);

    const fetchdata = async () => {
      try {
        const response = await fetch("http://localhost/week3_68704511/week3/php.api/show_customer.php");

        if (!response.ok) {
          throw new Error("ไม่สามารถดึงข้อมูลได้");
        }

        const result = await response.json();

        if (!result.success || !Array.isArray(result.data)) {
          throw new Error(result.message || "รูปแบบข้อมูลลูกค้าไม่ถูกต้อง");
        }

        customers.value = result.data;
      } catch (err) {
        error.value = err.message;
      } finally {
        loading.value = false;
      }
    };

    onMounted(() => {
      fetchdata();
    });

    return {
      customers,
      loading,
      error
    };
  }
};
</script>

<style scoped>
.customers-container {
  width: min(900px, calc(100% - 32px));
  margin: 40px auto;
  text-align: center;
}

.header-row {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 1rem;
}

.btn {
  border-radius: 10px;
}

table {
  width: 100%;
  margin: 0 auto;
  border-collapse: collapse;
}

th,
td {
  padding: 12px;
  border: 1px solid #d9d9d9;
  text-align: center;
}

th {
  color: #fff;
  background: #2c3e50;
}

tbody tr:nth-child(even) {
  background: #f7f7f7;
}
</style>
