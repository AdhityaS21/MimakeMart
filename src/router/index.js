import { createRouter, createWebHistory } from "vue-router";
import Dashboard from "@/views/Dashboard.vue";
import Tables from "@/views/Tables.vue";
import Billing from "@/views/Billing.vue";
import VirtualReality from "@/views/VirtualReality.vue";
import Profile from "@/views/Profile.vue";
import Rtl from "@/views/Rtl.vue";
import SignIn from "@/views/SignIn.vue";
import SignUp from "@/views/SignUp.vue";
import Products from "@/views/Products.vue";
import AddProduct from "@/views/AddProduct.vue";
import Categories from "@/views/Categories.vue";
import AddCategory from "@/views/AddCategory.vue";
import Users from "@/views/UsersPage/Users.vue";
import Roles from "@/views/RolesPage/Roles.vue";
import AddRole from "@/views/RolesPage/AddRole.vue";
import AddUser from "@/views/UsersPage/AddUser.vue";

const routes = [
  {
    path: "/",
    name: "/",
    redirect: "/dashboard",
  },
  {
    path: "/dashboard",
    name: "Dashboard",
    component: Dashboard,
  },
  {
    path: "/tables",
    name: "Tables",
    component: Tables,
  },
  {
    path: "/billing",
    name: "Billing",
    component: Billing,
  },
  {
    path: "/virtual-reality",
    name: "Virtual Reality",
    component: VirtualReality,
  },
  {
    path: "/profile",
    name: "Profile",
    component: Profile,
  },
  {
    path: "/rtl-page",
    name: "Rtl",
    component: Rtl,
  },
  {
    path: "/sign-in",
    name: "Sign In",
    component: SignIn,
  },
  {
    path: "/sign-up",
    name: "Sign Up",
    component: SignUp,
  },
  {
    path: "/products",
    name: "Products",
    component: Products,
    children: [
      {
        path: "add-product",
        name: "Add Product",
        component: AddProduct,
      },
      {
        path: ":id",
        name: "Edit Product",
        component: AddProduct,
      },
    ],
  },
  {
    path: "/categories",
    name: "Categories",
    component: Categories,
    children: [
      {
        path: "add-category",
        name: "Add Category",
        component: AddCategory,
      },
      {
        path: ":id",
        name: "Edit Category",
        component: AddCategory,
      },
    ],
  },
  {
    path: "/users",
    name: "Users",
    component: Users,
    children: [
      {
        path: "add-users",
        name: "Add Users",
        component: AddUser,
      },
      {
        path: ":id",
        name: "Edit Users",
        component: AddUser,
      }
    ],
  },
  {
    path: "/roles",
    name: "Roles",
    component: Roles,
    children: [
      {
        path: "add-roles",
        name: "Add Roles",
        component: AddRole,
      },
      {
        path: ":id",
        name: "Edit Roles",
        component: AddRole,
      }
    ],
  }
];

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes,
  linkActiveClass: "active",
});

export default router;
