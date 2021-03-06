import { Inertia } from '@inertiajs/inertia';
import { InertiaLink } from '@inertiajs/inertia-react';
import { Button, Col, Divider, Form, Input, Row, Select, Space } from 'antd';
import React from 'react';
import route from 'ziggy-js';

import Template from '../components/Template';
import IBreadcrumb from '../interfaces/IBreadcrumb';

const { Option } = Select;

const LocationsAdd: React.FC = () => {
  const [form] = Form.useForm();
  const tailLayout = {
    wrapperCol: { offset: 4, span: 16 },
  };
  const onLocationTypeChange = (value: string) => {
    form.setFieldsValue({ type: value });
  };
  const onFinish = (values: any) => {
    Inertia.post(route('locations.save'), values);
    form.resetFields();
  };
  return (
    <Template breadcrumbs={breadcrumbs}>
      <div
        className="site-layout-background"
        style={{ padding: 24, minHeight: 360 }}
      >
        <Divider orientation="left">Add location</Divider>
        <Row>
          <Col span={24}>
            <Form
              form={form}
              name="basic"
              labelCol={{ span: 4 }}
              wrapperCol={{ span: 8 }}
              initialValues={{ remember: true }}
              autoComplete="off"
              onFinish={onFinish}
            >
              <Form.Item
                label="Name"
                name="name"
                rules={[{ required: true, message: 'Enter the location name' }]}
              >
                <Input />
              </Form.Item>

              <Form.Item
                label="Short address"
                name="short_address"
                rules={[
                  {
                    required: true,
                    message: 'Enter the short address',
                    max: 250,
                  },
                ]}
              >
                <Input />
              </Form.Item>

              <Form.Item
                name="type"
                label="Location type"
                rules={[{ required: true }]}
              >
                <Select
                  placeholder="Select location type"
                  onChange={onLocationTypeChange}
                  allowClear
                >
                  <Option value="HOSPITAL">Hospital</Option>
                  <Option value="CLINIC">Clinic</Option>
                </Select>
              </Form.Item>

              <Form.Item {...tailLayout}>
                <Space size={18}>
                  <Button type="primary" htmlType="submit">
                    Save
                  </Button>
                  <InertiaLink href={route('locations')}>Back</InertiaLink>
                </Space>
              </Form.Item>
            </Form>
          </Col>
        </Row>
      </div>
    </Template>
  );
};

export default LocationsAdd;

const breadcrumbs: Array<IBreadcrumb> = [
  { name: 'Home', link: route('home') },
  { name: 'Locations', link: route('locations') },
  { name: 'Add', link: '' },
];
